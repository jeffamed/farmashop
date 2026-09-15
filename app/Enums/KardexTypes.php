<?php

namespace App\Enums;

enum KardexTypes: string
{
    case SALES = 'sales';
    case REFUND_CUSTOMER = 'refund_customer';
    case REFUND_SUPPLIER = 'refund_supplier';
    case PURCHASE  = 'order';
    case IN = 'in';
    case OUT = 'out';
    case TRANSFER = 'transfer';

    public function label(): string
    {
        return match ($this) {
            self::SALES => 'Venta',
            self::IN => 'Entrada',
            self::OUT => 'Salida',
            self::TRANSFER => 'Transferencia',
            self::PURCHASE => 'Compra',
            self::REFUND_CUSTOMER => 'Reembolso de venta',
            self::REFUND_SUPPLIER => 'Reembolso de compra',
            default => 'Ingreso',
        };
    }
}
