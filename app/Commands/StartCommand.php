<?php

namespace App\Commands;

use Telegram\Bot\Actions;
use Telegram\Bot\Commands\Command;

use App\Registration;
use App\Chat;

class StartCommand extends Command
{
    /**
     * @var string Command Name
     */
    protected $name = "start";

    /**
     * @var string Command Description
     */
    protected $description = "Start";

    /**
     * @inheritdoc
     */
    public function handle($arguments)
    {
        $chat = $this->getTelegram()->getWebhookUpdates()->getMessage()->getChat();
        // $chat_id = $chat->getId();
        // $chat_username = $chat->getUsername();
        // $chat_firstname = $chat->getFirstName();
        // $chat_lastname = $chat->getLastName();
        $chats = Chat::firstOrNew([
            'chat_id' => $chat->getId()
          ]);
        $chats->type = $chat->getType();
        if($chat->getType() == 'private'){
          $chats->username = $chat->getUsername();
          $chats->first_name = $chat->getFirstName();
          $chats->last_name = $chat->getLastName();
        }else if($chat->getType() == 'group'){
          $chats->title = $chat->getTitle();
        }
        $chats->save();
        // $registration = Registration::where('chat_id',$chat_id)->first();
        // $registration->alert = $alert;
        // $registration->save();

        $text = "Welcome to this ChatID ".json_encode($chat);

        $this->replyWithMessage(['text' => $text]);

    }
}
