<?php

namespace App\Commands;

use Telegram\Bot\Actions;
use Telegram\Bot\Commands\Command;
use App\Schedule;
use App\Registration;

class RegisterCommand extends Command
{
    /**
     * @var string Command Name
     */
    protected $name = "register";

    /**
     * @var string Command Description
     */
    protected $description = "Register Command";

    /**
     * @inheritdoc
     */
    public function handle($arguments)
    {
        $data = explode(' ', $arguments);

        $chat_id = $this->getTelegram()->getWebhookUpdates()->getMessage()->getChat()->getId();
        $city_id = $data[0];
        $registration = new Registration();
        $registration->chat_id = $chat_id;
        $registration->city_id = $city_id;
        $registration->save();

        $this->replyWithMessage(['text' => 'Hello! Thanks for registering']);

        // This will update the chat status to typing...
        // $this->replyWithChatAction(['action' => Actions::TYPING]);

        // This will prepare a list of available commands and send the user.
        // First, Get an array of all registered commands
        // They'll be in 'command-name' => 'Command Handler Class' format.
        // $commands = $this->getTelegram()->getCommands();
        //
        // // Build the list
        // $response = '';
        // foreach ($commands as $name => $command) {
        //     $response .= sprintf('/%s - %s' . PHP_EOL, $name, $command->getDescription());
        // }
        //
        // // Reply with the commands list
        // $this->replyWithMessage(['text' => $response]);
        //
        // // Trigger another command dynamically from within this command
        // // When you want to chain multiple commands within one or process the request further.
        // // The method supports second parameter arguments which you can optionally pass, By default
        // // it'll pass the same arguments that are received for this command originally.
        // $this->triggerCommand('subscribe');
    }
}
