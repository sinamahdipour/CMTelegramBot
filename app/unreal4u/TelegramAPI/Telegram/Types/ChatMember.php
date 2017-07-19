<?php

declare(strict_types = 1);

namespace App\unreal4u\TelegramAPI\Telegram\Types;

use App\unreal4u\TelegramAPI\Abstracts\TelegramTypes;

/**
 * This object contains information about one member of the chat
 *
 * Objects defined as-is july 2016
 *
 * @see https://core.telegram.org/bots/api#chatmember
 */
class ChatMember extends TelegramTypes
{
    /**
     * Information about the user
     * @var User
     */
    public $user;

    /**
     * The member's status in the chat. Can be “creator”, “administrator”, “member”, “left” or
     * “kicked”
     * @var string
     */
    public $status = '';

    public function mapSubObjects(string $key, array $data): TelegramTypes
    {
        switch ($key) {
            case 'user':
                return new User($data, $this->logger);
        }

        return parent::mapSubObjects($key, $data);
    }
}
