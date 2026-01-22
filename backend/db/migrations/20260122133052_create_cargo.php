<?php

declare(strict_types=1);

use Phinx\Db\Adapter\AdapterInterface;
use Phinx\Migration\AbstractMigration;

final class CreateCargo extends AbstractMigration
{
    public function change(): void
    {
        $this->table(
            'cargo',
            [
                'id' => false, 
                'primary_key' => 'cargo_id'
            ])
            ->addColumn(
                'cargo_id', 
                AdapterInterface::PHINX_TYPE_BIG_INTEGER,
                [
                    'null' => false, 
                    'identity' => true // auto-increment
                ]
            )
            ->addColumn(
                'amount',
                AdapterInterface::PHINX_TYPE_INTEGER,
                [
                    'null' => false
                ]
            )
            ->addColumn(
                'description',
                 AdapterInterface::PHINX_TYPE_STRING,
                 [
                    'limit' => 50,
                    'null' => false
                 ]
            )
            ->addColumn(
                'weight',
                AdapterInterface::PHINX_TYPE_DECIMAL, 
                [
                    'precision' => 10,
                    'scale' => 2,
                    'null' => false
                ]
            )
            ->addColumn(
                'order_date',
                AdapterInterface::PHINX_TYPE_DATETIME, 
                [
                    'null' => false
                ]
            )
            ->addColumn(
                'transport_type'
                ,AdapterInterface::PHINX_TYPE_STRING,
                [
                    'limit' => 255,
                    'null' => false
                ]
            )
            ->create();
    }
}
