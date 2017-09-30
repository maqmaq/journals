<?php

namespace App\Model;

use Maghead\Schema\DeclareSchema;

class UserSchema extends DeclareSchema
{
    public function schema()
    {
        $this->column('username')
            ->varchar(128)
            ->required()
            ->label('Username');

        $this->column('password')
            ->varchar(128)
            ->required()
            ->label('Password');

        $this->column('salt')
            ->varchar(32)
            ->label('Salt');

        $this->column('wallet')
            ->decimal(10, 2)
            ->label('Wallet');

    }

}