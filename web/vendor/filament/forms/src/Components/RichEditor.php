<?php

namespace Filament\Forms\Components;

use Closure;
use Filament\Actions\Action;
use Filament\Forms\Components\RichEditor\Actions\AttachFilesAction;
use Filament\Forms\Components\RichEditor\Actions\CustomBlockAction;
use Filament\Forms\Components\RichEditor\Actions\LinkAction;
use Filament\Forms\Components\RichEditor\EditorCommand;
use Filament\Forms\Components\RichEditor\FileAttachmentProviders\Contracts\FileAttachmentProvider;
use Filament\Forms\Components\RichEditor\Models\Contracts\HasRichContent;
use Filament\Forms\Components\RichEditor\Plugins\Contracts\RichContentPlugin;
use Filament\Forms\Components\RichEditor\RichContentAttribute;
use Filament\Forms\Components\RichEditor\RichContentCustomBlock;
use Filament\Forms\Components\RichEditor\RichContentRenderer;
use Filament\Forms\Components\RichEditor\RichEditorTool;
use Filament\Forms\Components\RichEditor\StateCasts\RichEditorStateCast;
use Filament\Schemas\Components\StateCasts\Contracts\StateCast;
use Filament\Support\Concerns\HasExtraAlpineAttributes;
use Filament\Support\Icons\Heroicon;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Tiptap\Editor;

class RichEditor extends Field implements Contracts\CanBeLengthConstrained
{
    use Concerns\CanBeLengthConstrained;
    use Concerns\HasExtraInputAttributes;
    use Concerns\HasFileAttachments;
    use Concerns\HasPlaceholder;
    use Concerns\InteractsWithToolbarButtons;
    use HasExtraAlpineAttributes;

    /**
     * @var view-string
     */
    protected string $view = 'filament-forms::components.rich-editor';

    protected string | Closure | null $uploadingFileMessage = null;

    protected bool | Closure | null $isJson = null;

    /**
     * @var array<RichContentPlugin | Closure>
     */
    protected array $plugins = [];

    /**
     * @var array<RichEditorTool | Closure>
     */
    protected array $tools = [];

    /**
     * @var array<string> | Closure | null
     */
    protected array | Closure | null $mergeTags = null;

    /**
     * @var array<class-string<RichContentCustomBlock>> | Closure | null
     */
    protected array | Closure | null $customBlocks = null;

    protected string | Closure | null $noMergeTagSearchResultsMessage = null;

    protected ?Closure $getFileAttachmentUrlFromAnotherRecordUsing = null;

    protected ?Closure $saveFileAttachmentFromAnotherRecordUsing = null;

    protected string | Closure | null $activePanel = null;

    /**
     * @var array<string, class-string<RichContentCustomBlock>>
     */
    protected array $cachedCustomBlocks;

    protected function setUp(): void
    {
        parent::setUp();

        $this->tools([
            RichEditorTool::make('bold')
                ->label(__('filament-forms::components.rich_editor.tools.bold'))
                ->jsHandler('$getEditor()?.chain().focus().toggleBold().run()')
                ->icon(Heroicon::Bold)
                ->iconAlias('forms:components.rich-editor.toolbar.bold'),
            RichEditorTool::make('italic')
                ->label(__('filament-forms::components.rich_editor.tools.italic'))
                ->jsHandler('$getEditor()?.chain().focus().toggleItalic().run()')
                ->icon(Heroicon::Italic)
                ->iconAlias('forms:components.rich-editor.toolbar.italic'),
            RichEditorTool::make('underline')
                ->label(__('filament-forms::components.rich_editor.tools.underline'))
                ->jsHandler('$getEditor()?.chain().focus().toggleUnderline().run()')
                ->icon(Heroicon::Underline)
                ->iconAlias('forms:components.rich-editor.toolbar.underline'),
            RichEditorTool::make('strike')
                ->label(__('filament-forms::components.rich_editor.tools.strike'))
                ->jsHandler('$getEditor()?.chain().focus().toggleStrike().run()')
                ->icon(Heroicon::Strikethrough)
                ->iconAlias('forms:components.rich-editor.toolbar.strike'),
            RichEditorTool::make('subscript')
                ->label(__('filament-forms::components.rich_editor.tools.subscript'))
                ->jsHandler('$getEditor()?.chain().focus().toggleSubscript().run()')
                ->icon('fi-s-subscript')
                ->iconAlias('forms:components.rich-editor.toolbar.subscript'),
            RichEditorTool::make('superscript')
                ->label(__('filament-forms::components.rich_editor.tools.superscript'))
                ->jsHandler('$getEditor()?.chain().focus().toggleSuperscript().run()')
                ->icon('fi-s-superscript')
                ->iconAlias('forms:components.rich-editor.toolbar.superscript'),
            RichEditorTool::make('link')
                ->label(__('filament-forms::components.rich_editor.tools.link'))
                ->action(arguments: '{ url: $getEditor().getAttributes(\'link\')?.href, shouldOpenInNewTab: $getEditor().getAttributes(\'link\')?.target === \'_blank\' }')
                ->icon(Heroicon::Link)
                ->iconAlias('forms:components.rich-editor.toolbar.link'),
            RichEditorTool::make('h1')
                ->label(__('filament-forms::components.rich_editor.tools.h1'))
                ->jsHandler('$getEditor()?.chain().focus().toggleHeading({ level: 1 }).run()')
                ->activeOptions(['level' => 1])
                ->icon(Heroicon::H1)
                ->iconAlias('forms:components.rich-editor.toolbar.h1'),
            RichEditorTool::make('h2')
                ->label(__('filament-forms::components.rich_editor.tools.h2'))
                ->jsHandler('$getEditor()?.chain().focus().toggleHeading({ level: 2 }).run()')
                ->activeOptions(['level' => 2])
                ->icon(Heroicon::H2)
                ->iconAlias('forms:components.rich-editor.toolbar.h2'),
            RichEditorTool::make('h3')
                ->label(__('filament-forms::components.rich_editor.tools.h3'))
                ->jsHandler('$getEditor()?.chain().focus().toggleHeading({ level: 3 }).run()')
                ->activeOptions(['level' => 3])
                ->icon(Heroicon::H3)
                ->iconAlias('forms:components.rich-editor.toolbar.h3'),
            RichEditorTool::make('blockquote')
                ->label(__('filament-forms::components.rich_editor.tools.blockquote'))
                ->jsHandler('$getEditor()?.chain().focus().toggleBlockquote().run()')
                ->icon(Heroicon::ChatBubbleBottomCenterText)
                ->iconAlias('forms:components.rich-editor.toolbar.blockquote'),
            RichEditorTool::make('codeBlock')
                ->label(__('filament-forms::components.rich_editor.tools.code_block'))
                ->jsHandler('$getEditor()?.chain().focus().toggleCodeBlock().run()')
                ->icon(Heroicon::CodeBracket)
                ->iconAlias('forms:components.rich-editor.toolbar.code-block'),
            RichEditorTool::make('bulletList')
                ->label(__('filament-forms::components.rich_editor.tools.bullet_list'))
                ->jsHandler('$getEditor()?.chain().focus().toggleBulletList().run()')
                ->icon(Heroicon::ListBullet)
                ->iconAlias('forms:components.rich-editor.toolbar.bullet-list'),
            RichEditorTool::make('orderedList')
                ->label(__('filament-forms::components.rich_editor.tools.ordered_list'))
                ->jsHandler('$getEditor()?.chain().focus().toggleOrderedList().run()')
                ->icon(Heroicon::NumberedList)
                ->iconAlias('forms:components.rich-editor.toolbar.ordered-list'),
            RichEditorTool::make('attachFiles')
                ->label(__('filament-forms::components.rich_editor.tools.attach_files'))
                ->action(arguments: '{ alt: $getEditor().getAttributes(\'image\')?.alt, id: $getEditor().getAttributes(\'image\')?.id, src: $getEditor().getAttributes(\'image\')?.src }')
                ->activeKey('image')
                ->icon(Heroicon::PaperClip)
                ->iconAlias('forms:components.rich-editor.toolbar.attach-files'),
            RichEditorTool::make('customBlocks')
                ->label(__('filament-forms::components.rich_editor.tools.custom_blocks'))
                ->jsHandler('togglePanel(\'customBlocks\')')
                ->activeJsExpression('isPanelActive(\'customBlocks\')')
                ->icon(Heroicon::SquaresPlus)
                ->iconAlias('forms:components.rich-editor.toolbar.custom-blocks'),
            RichEditorTool::make('mergeTags')
                ->label(__('filament-forms::components.rich_editor.tools.merge_tags'))
                ->jsHandler('togglePanel(\'mergeTags\')')
                ->activeJsExpression('isPanelActive(\'mergeTags\')')
                ->icon('fi-s-merge-tag')
                ->iconAlias('forms:components.rich-editor.toolbar.merge-tags'),
            RichEditorTool::make('undo')
                ->label(__('filament-forms::components.rich_editor.tools.undo'))
                ->jsHandler('$getEditor()?.chain().focus().undo().run()')
                ->icon(Heroicon::ArrowUturnLeft)
                ->iconAlias('forms:components.rich-editor.toolbar.undo'),
            RichEditorTool::make('redo')
                ->label(__('filament-forms::components.rich_editor.tools.redo'))
                ->jsHandler('$getEditor()?.chain().focus().redo().run()')
                ->icon(Heroicon::ArrowUturnRight)
                ->iconAlias('forms:components.rich-editor.toolbar.redo'),
        ]);

        $this->beforeStateDehydrated(function (RichEditor $component, ?array $rawState, ?Model $record): void {
            $fileAttachmentProvider = $component->getFileAttachmentProvider();

            if ($fileAttachmentProvider?->isExistingRecordRequiredToSaveNewFileAttachments() && (! $record)) {
                return;
            }

            $fileAttachmentIds = [];

            $component->rawState(
                $component->getTipTapEditor()
                    ->setContent($rawState ?? [
                        'type' => 'doc',
                        'content' => [],
                    ])
                    ->descendants(function (object &$node) use ($component, &$fileAttachmentIds): void {
                        if ($node->type !== 'image') {
                            return;
                        }

                        if (blank($node->attrs->id ?? null)) {
                            return;
                        }

                        $attachment = $component->getUploadedFileAttachment($node->attrs->id);

                        if ($attachment) {
                            $node->attrs->id = $component->saveUploadedFileAttachment($attachment);
                            $node->attrs->src = $component->getFileAttachmentUrl($node->attrs->id);

                            $fileAttachmentIds[] = $node->attrs->id;

                            return;
                        }

                        if (filled($component->getFileAttachmentUrl($node->attrs->id))) {
                            $fileAttachmentIds[] = $node->attrs->id;

                            return;
                        }

                        $fileAttachmentIdFromAnotherRecord = $component->saveFileAttachmentFromAnotherRecord($node->attrs->id);

                        if (blank($fileAttachmentIdFromAnotherRecord)) {
                            $fileAttachmentIds[] = $node->attrs->id;

                            return;
                        }

                        $node->attrs->id = $fileAttachmentIdFromAnotherRecord;
                        $node->attrs->src = $component->getFileAttachmentUrl($fileAttachmentIdFromAnotherRecord) ?? $node->attrs->src ?? null;
                    })
                    ->getDocument(),
            );

            $fileAttachmentProvider?->cleanUpFileAttachments(exceptIds: $fileAttachmentIds);
        }, shouldUpdateValidatedStateAfter: true);

        $this->saveRelationshipsUsing(function (RichEditor $component, ?array $rawState, Model $record): void {
            $fileAttachmentProvider = $component->getFileAttachmentProvider();

            if (! $fileAttachmentProvider) {
                return;
            }

            if (! $fileAttachmentProvider->isExistingRecordRequiredToSaveNewFileAttachments()) {
                return;
            }

            if (! $record->wasRecentlyCreated) {
                return;
            }

            $fileAttachmentIds = [];

            $component->rawState(
                $component->getTipTapEditor()
                    ->setContent($rawState ?? [
                        'type' => 'doc',
                        'content' => [],
                    ])
                    ->descendants(function (object &$node) use ($component, &$fileAttachmentIds): void {
                        if ($node->type !== 'image') {
                            return;
                        }

                        if (blank($node->attrs->id ?? null)) {
                            return;
                        }

                        $attachment = $component->getUploadedFileAttachment($node->attrs->id);

                        if ($attachment) {
                            $node->attrs->id = $component->saveUploadedFileAttachment($attachment);
                            $node->attrs->src = $component->getFileAttachmentUrl($node->attrs->id);

                            $fileAttachmentIds[] = $node->attrs->id;

                            return;
                        }

                        if (filled($component->getFileAttachmentUrl($node->attrs->id))) {
                            $fileAttachmentIds[] = $node->attrs->id;

                            return;
                        }

                        $fileAttachmentIdFromAnotherRecord = $component->saveFileAttachmentFromAnotherRecord($node->attrs->id);

                        if (blank($fileAttachmentIdFromAnotherRecord)) {
                            $fileAttachmentIds[] = $node->attrs->id;

                            return;
                        }

                        $node->attrs->id = $fileAttachmentIdFromAnotherRecord;
                        $node->attrs->src = $component->getFileAttachmentUrl($fileAttachmentIdFromAnotherRecord) ?? $node->attrs->src ?? null;
                    })
                    ->getDocument(),
            );

            $record->setAttribute($component->getContentAttribute()->getName(), $component->getState());
            $record->save();

            $fileAttachmentProvider->cleanUpFileAttachments(exceptIds: $fileAttachmentIds);
        });
    }

    public function isDehydrated(): bool
    {
        if ($this->getFileAttachmentProvider()?->isExistingRecordRequiredToSaveNewFileAttachments() && (! $this->getRecord())) {
            return false;
        }

        return parent::isDehydrated();
    }

    /**
     * @param  array<RichContentPlugin> | Closure  $extensions
     */
    public function plugins(array | Closure $extensions): static
    {
        $this->plugins = [
            ...$this->plugins,
            ...is_array($extensions) ? $extensions : [$extensions],
        ];

        return $this;
    }

    /**
     * @param  array<RichEditorTool> | Closure  $tools
     */
    public function tools(array | Closure $tools): static
    {
        $this->tools = [
            ...$this->tools,
            ...is_array($tools) ? $tools : [$tools],
        ];

        return $this;
    }

    /**
     * @return array<StateCast>
     */
    public function getDefaultStateCasts(): array
    {
        return [
            ...parent::getDefaultStateCasts(),
            app(RichEditorStateCast::class, ['richEditor' => $this]),
        ];
    }

    /**
     * @param  array<EditorCommand>  $commands
     * @param  ?array<string, mixed>  $editorSelection
     */
    public function runCommands(array $commands, ?array $editorSelection = null): void
    {
        $key = $this->getKey();
        $livewire = $this->getLivewire();

        $livewire->dispatch(
            'run-rich-editor-commands',
            awaitSchemaComponent: $key,
            livewireId: $livewire->getId(),
            key: $key,
            editorSelection: $editorSelection,
            commands: array_map(fn (EditorCommand $command): array => $command->toArray(), $commands),
        );
    }

    public function uploadingFileMessage(string | Closure | null $message): static
    {
        $this->uploadingFileMessage = $message;

        return $this;
    }

    public function getUploadingFileMessage(): string
    {
        return $this->evaluate($this->uploadingFileMessage) ?? __('filament::components/button.messages.uploading_file');
    }

    public function json(bool | Closure | null $condition = true): static
    {
        $this->isJson = $condition;

        return $this;
    }

    public function isJson(): bool
    {
        return $this->evaluate($this->isJson) ?? $this->getContentAttribute()?->isJson() ?? false;
    }

    public function getTipTapEditor(): Editor
    {
        return RichContentRenderer::make()
            ->plugins($this->getPlugins())
            ->getEditor();
    }

    /**
     * @return array<RichContentPlugin>
     */
    public function getPlugins(): array
    {
        return [
            ...$this->getContentAttribute()?->getPlugins() ?? [],
            ...array_reduce(
                $this->plugins,
                function (array $carry, RichContentPlugin | Closure $plugin): array {
                    if ($plugin instanceof Closure) {
                        $plugin = $this->evaluate($plugin);
                    }

                    return [
                        ...$carry,
                        ...Arr::wrap($plugin),
                    ];
                },
                initial: [],
            ),
        ];
    }

    /**
     * @return array<string>
     */
    public function getTipTapJsExtensions(): array
    {
        return array_reduce(
            $this->getPlugins(),
            fn (array $carry, RichContentPlugin $plugin): array => [
                ...$carry,
                ...$plugin->getTipTapJsExtensions(),
            ],
            initial: [],
        );
    }

    /**
     * @return array<string, RichEditorTool>
     */
    public function getTools(): array
    {
        return array_reduce(
            [
                ...array_reduce(
                    $this->getPlugins(),
                    fn (array $carry, RichContentPlugin $plugin): array => [
                        ...$carry,
                        ...$plugin->getEditorTools(),
                    ],
                    initial: [],
                ),
                ...array_reduce(
                    $this->tools,
                    function (array $carry, RichEditorTool | Closure $tool): array {
                        if ($tool instanceof Closure) {
                            $tool = $this->evaluate($tool);
                        }

                        return [
                            ...$carry,
                            ...Arr::wrap($tool),
                        ];
                    },
                    initial: [],
                ),
            ],
            fn (array $carry, RichEditorTool $tool): array => [
                ...$carry,
                $tool->getName() => $tool->editor($this),
            ],
            initial: [],
        );
    }

    public function getContentAttribute(): ?RichContentAttribute
    {
        $model = $this->getModelInstance();

        if (! ($model instanceof HasRichContent)) {
            return null;
        }

        return $model->getRichContentAttribute($this->getName());
    }

    public function getDefaultFileAttachmentsDiskName(): ?string
    {
        return $this->getContentAttribute()?->getFileAttachmentsDiskName();
    }

    public function getDefaultFileAttachmentsVisibility(): ?string
    {
        return $this->getContentAttribute()?->getFileAttachmentsVisibility();
    }

    public function getFileAttachmentProvider(): ?FileAttachmentProvider
    {
        return $this->getContentAttribute()?->getFileAttachmentProvider();
    }

    public function getDefaultFileAttachmentUrl(mixed $file): ?string
    {
        return $this->getFileAttachmentProvider()?->getFileAttachmentUrl($file);
    }

    public function defaultSaveUploadedFileAttachment(TemporaryUploadedFile $file): mixed
    {
        return $this->getFileAttachmentProvider()?->saveUploadedFileAttachment($file);
    }

    /**
     * @return array<string | array<string>>
     */
    public function getDefaultToolbarButtons(): array
    {
        return [
            ['bold', 'italic', 'underline', 'strike', 'subscript', 'superscript', 'link'],
            ['h2', 'h3'],
            ['blockquote', 'codeBlock', 'bulletList', 'orderedList'],
            [
                'attachFiles',
                ...(filled($this->getCustomBlocks()) ? ['customBlocks'] : []),
                ...(filled($this->getMergeTags()) ? ['mergeTags'] : []),
            ],
            ['undo', 'redo'],
        ];
    }

    public function getFileAttachmentUrlFromAnotherRecordUsing(?Closure $callback): static
    {
        $this->getFileAttachmentUrlFromAnotherRecordUsing = $callback;

        return $this;
    }

    public function saveFileAttachmentFromAnotherRecordUsing(?Closure $callback): static
    {
        $this->saveFileAttachmentFromAnotherRecordUsing = $callback;

        return $this;
    }

    public function getFileAttachmentUrlFromAnotherRecord(mixed $file): ?string
    {
        return $this->evaluate($this->getFileAttachmentUrlFromAnotherRecordUsing, [
            'file' => $file,
        ]);
    }

    public function saveFileAttachmentFromAnotherRecord(mixed $file): mixed
    {
        return $this->evaluate($this->saveFileAttachmentFromAnotherRecordUsing, [
            'file' => $file,
        ]);
    }

    /**
     * @return array<Action>
     */
    public function getDefaultActions(): array
    {
        return [
            AttachFilesAction::make(),
            CustomBlockAction::make(),
            LinkAction::make(),
            ...array_reduce(
                $this->getPlugins(),
                fn (array $carry, RichContentPlugin $plugin): array => [
                    ...$carry,
                    ...$plugin->getEditorActions(),
                ],
                initial: [],
            ),
        ];
    }

    /**
     * @param  array<string> | Closure | null  $tags
     */
    public function mergeTags(array | Closure | null $tags): static
    {
        $this->mergeTags = $tags;

        return $this;
    }

    /**
     * @return array<string>
     */
    public function getMergeTags(): array
    {
        return $this->evaluate($this->mergeTags) ?? $this->getContentAttribute()?->getMergeTags() ?? [];
    }

    public function noMergeTagSearchResultsMessage(string | Closure | null $message): static
    {
        $this->noMergeTagSearchResultsMessage = $message;

        return $this;
    }

    public function getNoMergeTagSearchResultsMessage(): string | Htmlable
    {
        return $this->evaluate($this->noMergeTagSearchResultsMessage) ?? __('filament-forms::components.rich_editor.no_merge_tag_search_results_message');
    }

    public function activePanel(string | Closure | null $panel): static
    {
        $this->activePanel = $panel;

        return $this;
    }

    public function getActivePanel(): ?string
    {
        return $this->evaluate($this->activePanel);
    }

    /**
     * @param  array<class-string<RichContentCustomBlock>> | Closure | null  $blocks
     */
    public function customBlocks(array | Closure | null $blocks): static
    {
        $this->customBlocks = $blocks;

        return $this;
    }

    /**
     * @return array<class-string<RichContentCustomBlock>>
     */
    public function getCustomBlocks(): array
    {
        return $this->evaluate($this->customBlocks) ?? $this->getContentAttribute()?->getCustomBlocks() ?? [];
    }

    /**
     * @return array<string, class-string<RichContentCustomBlock>>
     */
    public function getCachedCustomBlocks(): array
    {
        if (isset($this->cachedCustomBlocks)) {
            return $this->cachedCustomBlocks;
        }

        foreach ($this->getCustomBlocks() as $block) {
            $this->cachedCustomBlocks[$block::getId()] = $block;
        }

        return $this->cachedCustomBlocks;
    }

    /**
     * @return ?class-string<RichContentCustomBlock>
     */
    public function getCustomBlock(string $id): ?string
    {
        return $this->getCachedCustomBlocks()[$id] ?? null;
    }
}
