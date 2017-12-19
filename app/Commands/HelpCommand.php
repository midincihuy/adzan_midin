<?php

namespace App\Commands;

use Telegram\Bot\Actions;
use Telegram\Bot\Commands\Command;

use App\Registration;
use App\Chat;

class HelpCommand extends Command
{
    /**
     * @var string Command Name
     */
    protected $name = "help";

    /**
     * @var string Command Description
     */
    protected $description = "Help Command";

    /**
     * @inheritdoc
     */
    public function handle($arguments)
    {
      $commands = $this->getTelegram()->getCommands();

      // Build the list
      $text = '';
      foreach ($commands as $name => $command) {
          $text .= sprintf('/%s - %s' . PHP_EOL, $name, $command->getDescription());
      }
      $text .= "\n\n\nSaran dan Kritik silahkan email ke : mailnidimah.hamidin@gmail.com";
      $this->replyWithMessage(['text' => $text]);
    }
}
