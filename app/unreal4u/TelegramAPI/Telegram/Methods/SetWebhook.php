<?php

declare(strict_types = 1);

namespace App\unreal4u\TelegramAPI\Telegram\Methods;

use Psr\Log\LoggerInterface;
use App\unreal4u\TelegramAPI\Abstracts\TelegramMethods;
use App\unreal4u\TelegramAPI\Abstracts\TelegramTypes;
use App\unreal4u\TelegramAPI\InternalFunctionality\TelegramRawData;
use App\unreal4u\TelegramAPI\Telegram\Types\Custom\InputFile;
use App\unreal4u\TelegramAPI\Telegram\Types\Custom\ResultBoolean;

/**
 * Use this method to specify a url and receive incoming updates via an outgoing webhook. Whenever there is an update
 * for the bot, we will send an HTTPS POST request to the specified url, containing a JSON-serialized Update. In case of
 * an unsuccessful request, we will give up after a reasonable amount of attempts. Returns true.
 *
 * If you'd like to make sure that the Webhook request comes from Telegram, we recommend using a secret path in the URL,
 * e.g. https://www.example.com/<token>. Since nobody else knows your bot‘s token, you can be pretty sure it’s us.
 *
 * Notes
 * <ul>
 *  <li>You will not be able to receive updates using getUpdates for as long as an outgoing webhook is set up.</li>
 *  <li>To use a self-signed certificate, you need to upload your public key certificate using certificate parameter.
 *      Please upload as InputFile, sending a String will not work.</li>
 *  <li>Ports currently supported for Webhooks: 443, 80, 88, 8443.</li>
 * </ul>
 *
 * Objects defined as-is January 2017
 *
 * @see https://core.telegram.org/bots/api#setwebhook
 */
class SetWebhook extends TelegramMethods
{
    /**
     * Optional. HTTPS url to send updates to. Use an empty string to remove webhook integration
     * @var string
     */
    public $url = '';

    /**
     * Optional. Upload your public key certificate so that the root certificate in use can be checked. See our
     * self-signed guide for details.
     * @see https://core.telegram.org/bots/self-signed
     * @var InputFile
     */
    public $certificate;

    /**
     * Maximum allowed number of simultaneous HTTPS connections to the webhook for update delivery, 1-100. Defaults to
     * 40. Use lower values to limit the load on your bot‘s server, and higher values to increase your bot’s
     * throughput
     * @var int
     */
    public $max_connections = 40;

    /**
     * List the types of updates you want your bot to receive. For example, specify
     * [“message”, “edited_channel_post”, “callback_query”]
     * to only receive updates of these types. See Update for a complete list of available update types. Specify an
     * empty list to receive all updates regardless of type (default). If not specified, the previous setting will be
     * used.
     *
     * Please note that this parameter doesn't affect updates created before the call to the setWebhook, so unwanted
     * updates may be received for a short period of time.
     * @see Update
     * @var string[]
     */
    public $allowed_updates = [];

    public static function bindToObject(TelegramRawData $data, LoggerInterface $logger): TelegramTypes
    {
        return new ResultBoolean($data->getResultBoolean(), $logger);
    }

    public function getMandatoryFields(): array
    {
        return [
            'url',
        ];
    }
}
