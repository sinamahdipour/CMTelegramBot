<?php

declare(strict_types = 1);

namespace App\unreal4u\TelegramAPI\Telegram\Methods;

use Psr\Log\LoggerInterface;
use App\unreal4u\TelegramAPI\Abstracts\TelegramMethods;
use App\unreal4u\TelegramAPI\Abstracts\TelegramTypes;
use App\unreal4u\TelegramAPI\Exceptions\InvalidResultType;
use App\unreal4u\TelegramAPI\InternalFunctionality\TelegramRawData;
use App\unreal4u\TelegramAPI\Telegram\Types\Custom\ResultBoolean;
use App\unreal4u\TelegramAPI\Telegram\Types\Inline\Keyboard\Markup;
use App\unreal4u\TelegramAPI\Telegram\Types\Message;

/**
 * Use this method to edit captions of messages sent by the bot or via the bot (for inline bots). On success, if edited
 * message is sent by the bot, the edited Message is returned, otherwise True is returned.
 *
 * Objects defined as-is july 2016
 *
 * @see https://core.telegram.org/bots/api#editmessagecaption
 */
class EditMessageCaption extends TelegramMethods
{
    /**
     * Required if inline_message_id is not specified. Unique identifier for the target chat or username of the target
     * channel (in the format @channelusername)
     * @var string
     */
    public $chat_id = '';

    /**
     * Required if inline_message_id is not specified. Unique identifier of the sent message
     * @var int
     */
    public $message_id = 0;

    /**
     * Required if chat_id and message_id are not specified. Identifier of the inline message
     * @var string
     */
    public $inline_message_id = '';

    /**
     * New caption of the message
     * @var string
     */
    public $caption = '';

    /**
     * Optional. A JSON-serialized object for an inline keyboard.
     * @var Markup
     */
    public $reply_markup;

    public function getMandatoryFields(): array
    {
        $returnValue = [];
        return $this->mandatoryUserOrInlineMessageId($returnValue);
    }

    public static function bindToObject(TelegramRawData $data, LoggerInterface $logger): TelegramTypes
    {
        $typeOfResult = $data->getTypeOfResult();
        switch ($typeOfResult) {
            case 'array':
                return new Message($data->getResult(), $logger);
            case 'boolean':
                return new ResultBoolean($data->getResultBoolean(), $logger);
            default:
                throw new InvalidResultType('Result is of type: %s. Expecting one of array or boolean');
        }
    }
}
