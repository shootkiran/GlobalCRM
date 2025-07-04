<?php

return [

    'builder' => [

        'actions' => [

            'clone' => [
                'label' => 'Clonar',
            ],

            'add' => [

                'label' => 'Añadir a :label',

                'modal' => [

                    'heading' => 'Añadir a :label',

                    'actions' => [

                        'add' => [
                            'label' => 'Añadir',
                        ],

                    ],

                ],

            ],

            'add_between' => [

                'label' => 'Insertar entre bloques',

                'modal' => [

                    'heading' => 'Añadir a :label',

                    'actions' => [

                        'add' => [
                            'label' => 'Añadir',
                        ],

                    ],

                ],

            ],

            'delete' => [
                'label' => 'Borrar',
            ],

            'edit' => [

                'label' => 'Editar',

                'modal' => [

                    'heading' => 'Editar bloque',

                    'actions' => [

                        'save' => [
                            'label' => 'Guardar cambios',
                        ],

                    ],

                ],

            ],

            'reorder' => [
                'label' => 'Mover',
            ],

            'move_down' => [
                'label' => 'Bajar',
            ],

            'move_up' => [
                'label' => 'Subir',
            ],

            'collapse' => [
                'label' => 'Contraer',
            ],

            'expand' => [
                'label' => 'Expandir',
            ],

            'collapse_all' => [
                'label' => 'Contraer todo',
            ],

            'expand_all' => [
                'label' => 'Expandir todo',
            ],

        ],

    ],

    'checkbox_list' => [

        'actions' => [

            'deselect_all' => [
                'label' => 'Deseleccionar todos',
            ],

            'select_all' => [
                'label' => 'Seleccionar todos',
            ],

        ],

    ],

    'file_upload' => [

        'editor' => [

            'actions' => [

                'cancel' => [
                    'label' => 'Cancelar',
                ],

                'drag_crop' => [
                    'label' => 'Modo de arrastre "recortar"',
                ],

                'drag_move' => [
                    'label' => 'Modo de arrastre "mover"',
                ],

                'flip_horizontal' => [
                    'label' => 'Voltear imagen horizontalmente',
                ],

                'flip_vertical' => [
                    'label' => 'Voltear imagen verticalmente',
                ],

                'move_down' => [
                    'label' => 'Mover imagen hacia abajo',
                ],

                'move_left' => [
                    'label' => 'Mover imagen a la izquierda',
                ],

                'move_right' => [
                    'label' => 'Mover imagen a la derecha',
                ],

                'move_up' => [
                    'label' => 'Mover imagen hacia arriba',
                ],

                'reset' => [
                    'label' => 'Reiniciar',
                ],

                'rotate_left' => [
                    'label' => 'Girar imagen a la izquierda',
                ],

                'rotate_right' => [
                    'label' => 'Girar imagen a la derecha',
                ],

                'set_aspect_ratio' => [
                    'label' => 'Establecer relación de aspecto a :ratio',
                ],

                'save' => [
                    'label' => 'Guardar',
                ],

                'zoom_100' => [
                    'label' => 'Ampliar imagen al 100%',
                ],

                'zoom_in' => [
                    'label' => 'Acercarse',
                ],

                'zoom_out' => [
                    'label' => 'Alejarse',
                ],

            ],

            'fields' => [

                'height' => [
                    'label' => 'Altura',
                    'unit' => 'px',
                ],

                'rotation' => [
                    'label' => 'Rotación',
                    'unit' => 'grados',
                ],

                'width' => [
                    'label' => 'Ancho',
                    'unit' => 'px',
                ],

                'x_position' => [
                    'label' => 'X',
                    'unit' => 'px',
                ],

                'y_position' => [
                    'label' => 'Y',
                    'unit' => 'px',
                ],

            ],

            'aspect_ratios' => [

                'label' => 'Relaciones de aspecto',

                'no_fixed' => [
                    'label' => 'Libre',
                ],

            ],

            'svg' => [

                'messages' => [
                    'confirmation' => 'No se recomienda editar archivos SVG ya que puede provocar una pérdida de calidad al escalar.\n ¿Está seguro de que desea continuar?',
                    'disabled' => 'La edición de archivos SVG está deshabilitada ya que puede provocar una pérdida de calidad al escalar.',
                ],

            ],

        ],

    ],

    'key_value' => [

        'actions' => [

            'add' => [
                'label' => 'Añadir fila',
            ],

            'delete' => [
                'label' => 'Eliminar fila',
            ],

            'reorder' => [
                'label' => 'Reordenar fila',
            ],

        ],

        'fields' => [

            'key' => [
                'label' => 'Clave',
            ],

            'value' => [
                'label' => 'Valor',
            ],

        ],

    ],

    'markdown_editor' => [

        'tools' => [
            'attach_files' => 'Adjuntar archivos',
            'blockquote' => 'Cita',
            'bold' => 'Negrita',
            'bullet_list' => 'Viñetas',
            'code_block' => 'Bloque de código',
            'heading' => 'Encabezado',
            'italic' => 'Cursiva',
            'link' => 'Enlace',
            'ordered_list' => 'Lista numerada',
            'strike' => 'Tachado',
            'redo' => 'Rehacer',
            'table' => 'Tabla',
            'undo' => 'Deshacer',
        ],

    ],

    'modal_table_select' => [

        'actions' => [

            'select' => [

                'label' => 'Seleccionar',

                'actions' => [

                    'select' => [
                        'label' => 'Seleccionar',
                    ],

                ],

            ],

        ],

    ],

    'radio' => [

        'boolean' => [
            'true' => 'Sí',
            'false' => 'No',
        ],

    ],

    'repeater' => [

        'actions' => [

            'add' => [
                'label' => 'Añadir a :label',
            ],

            'add_between' => [
                'label' => 'Insertar entre',
            ],

            'delete' => [
                'label' => 'Borrar',
            ],

            'reorder' => [
                'label' => 'Mover',
            ],

            'clone' => [
                'label' => 'Clonar',
            ],

            'move_down' => [
                'label' => 'Bajar',
            ],

            'move_up' => [
                'label' => 'Subir',
            ],

            'collapse' => [
                'label' => 'Contraer',
            ],

            'expand' => [
                'label' => 'Expandir',
            ],

            'collapse_all' => [
                'label' => 'Contraer todo',
            ],

            'expand_all' => [
                'label' => 'Expandir todo',
            ],

        ],

    ],

    'rich_editor' => [

        'actions' => [

            'attach_files' => [

                'label' => 'Subir archivo',

                'modal' => [

                    'heading' => 'Subir archivo',

                    'form' => [

                        'file' => [

                            'label' => [
                                'new' => 'Archivo',
                                'existing' => 'Reemplazar archivo',
                            ],

                        ],

                        'alt' => [

                            'label' => [
                                'new' => 'Texto alternativo',
                                'existing' => 'Cambiar texto alternativo',
                            ],

                        ],

                    ],

                ],

            ],

            'custom_block' => [

                'modal' => [

                    'actions' => [

                        'insert' => [
                            'label' => 'Insertar',
                        ],

                        'save' => [
                            'label' => 'Guardar',
                        ],

                    ],

                ],

            ],

            'link' => [

                'label' => 'Editar',

                'modal' => [

                    'heading' => 'Enlace',

                    'form' => [

                        'url' => [
                            'label' => 'URL',
                        ],

                        'should_open_in_new_tab' => [
                            'label' => 'Abrir en una nueva pestaña',
                        ],

                    ],

                ],

            ],

        ],

        'no_merge_tag_search_results_message' => 'No se encontraron etiquetas dinámicas.',

        'tools' => [
            'attach_files' => 'Adjuntar archivos',
            'blockquote' => 'Cita',
            'bold' => 'Negrita',
            'bullet_list' => 'Viñetas',
            'code_block' => 'Bloque de código',
            'custom_blocks' => 'Bloques',
            'h1' => 'Título',
            'h2' => 'Encabezado',
            'h3' => 'Subencabezado',
            'italic' => 'Cursiva',
            'link' => 'Enlace',
            'merge_tags' => 'Etiquetas dinámicas',
            'ordered_list' => 'Lista numerada',
            'redo' => 'Rehacer',
            'strike' => 'Tachar',
            'subscript' => 'Subíndice',
            'superscript' => 'Superíndice',
            'underline' => 'Subrayar',
            'undo' => 'Deshacer',
        ],

    ],

    'select' => [

        'actions' => [

            'create_option' => [

                'label' => 'Crear',

                'modal' => [

                    'heading' => 'Nuevo',

                    'actions' => [

                        'create' => [
                            'label' => 'Crear',
                        ],

                        'create_another' => [
                            'label' => 'Crear y crear otro',
                        ],

                    ],

                ],

            ],

            'edit_option' => [

                'label' => 'Editar',

                'modal' => [

                    'heading' => 'Editar',

                    'actions' => [

                        'save' => [
                            'label' => 'Guardar',
                        ],

                    ],

                ],

            ],

        ],

        'boolean' => [
            'true' => 'Sí',
            'false' => 'No',
        ],

        'loading_message' => 'Cargando...',

        'max_items_message' => 'Solo :count pueden ser seleccionados.',

        'no_search_results_message' => 'No se encontraron coincidencias con su búsqueda.',

        'placeholder' => 'Seleccione una opción',

        'searching_message' => 'Buscando...',

        'search_prompt' => 'Teclee para buscar...',

    ],

    'tags_input' => [
        'placeholder' => 'Nueva etiqueta',
    ],

    'text_input' => [

        'actions' => [

            'hide_password' => [
                'label' => 'Ocultar contraseña',
            ],

            'show_password' => [
                'label' => 'Mostrar contraseña',
            ],

        ],

    ],

    'toggle_buttons' => [

        'boolean' => [
            'true' => 'Sí',
            'false' => 'No',
        ],

    ],

];
