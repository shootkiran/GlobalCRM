<?php

namespace App\Filament\Resources\Invoices\Pages;

use App\Filament\Resources\Invoices\InvoiceResource;
use App\Models\Payment;
use Filament\Resources\Pages\CreateRecord;

class CreateInvoice extends CreateRecord
{
    protected static string $resource = InvoiceResource::class;
    protected function mutateFormDataBeforeCreate(array $data): array
    {
        // Capture and remove payment fields if payment_received is enabled
        $this->paymentReceivedData = null;
        if ($data['payment_received'] == true) {
            $this->paymentReceivedData = [
                'receive_ledger_id' => $data['receive_ledger_id'],
                'note' => $data['payment_note'] ?? null,
                'amount' => $data['payment_amount'],
            ];
            unset($data['receive_ledger_id'], $data['payment_method'], $data['payment_note'], $data['payment_amount']);
        }
        unset($data['payment_received']);

        return $data;
    }

    protected function afterCreate(): void
    {
        if ($this->paymentReceivedData) {
          $payment =   Payment::create([
                'customer_id' => $this->record->customer_id,
                'receive_ledger_id' => $this->paymentReceivedData['receive_ledger_id'],
                'note' => $this->paymentReceivedData['note'],
                'amount' => $this->paymentReceivedData['amount'],
                'date' => now(),
            ]);
            $payment->generateJournals();
            
        }
        $this->record->generateJournals();
    }
}
