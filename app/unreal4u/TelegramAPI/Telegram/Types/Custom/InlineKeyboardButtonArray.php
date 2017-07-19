<?php

declare(strict_types = 1);

namespace App\unreal4u\TelegramAPI\Telegram\Types\Custom;

use App\unreal4u\TelegramAPI\Abstracts\CustomType;
use App\unreal4u\TelegramAPI\Telegram\Types\Inline\Keyboard\Button;
use App\unreal4u\TelegramAPI\Interfaces\CustomArrayType;
use Psr\Log\LoggerInterface;

/**
 * Mockup class to generate a real telegram update representation
 */
class InlineKeyboardButtonArray extends CustomType implements CustomArrayType
{
    public function __construct(array $data = null, LoggerInterface $logger = null)
    {
        if (count($data) !== 0) {
            foreach ($data as $rowId => $button) {
                $this->data[$rowId][] = new Button($data, $logger);
            }
        }
    }

    /**
     * Traverses through our $data, yielding the result set
     *
     * @return Button[]
     */
    public function traverseObject()
    {
        foreach ($this->data as $inlineKeyboardButton) {
            yield $inlineKeyboardButton;
        }
    }
}
