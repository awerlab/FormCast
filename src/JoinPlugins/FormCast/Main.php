<?php

namespace JoinPlugins\FormCast;

use pocketmine\Player;
use pocketmine\Server;
use pocketmine\event\Listener;
use pocketmine\plugin\PluginBase;
use pocketmine\command\{CommandSender, Command};

class Main extends PluginBase implements Listener{

	public function onEnable(){
		$this->getServer()->getPluginManager()->registerEvents($this, $this);
		$this->getLogger()->info("Плагин успешно запущен");
	}

	public function onCommand(CommandSender $s, Command $cmd, String $label, array $args) : bool{
		if($cmd == "broadcast"){
			$this->BroadcastMenu($s);
		}
		return true;
	}

	public function BroadcastMenu($s){
		$api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
		$form = $api->createCustomForm(function (Player $s, array $data = null) {
			$result = $data;
			if($result === null){
				return true;
			}
			if(count($result) != 0){
				$this->getServer()->broadcastMessage($result[0]);
			}

			else{
				$s->sendMessage("§4§lТы не написал сообщение!");
			}

		});
		$form->setTitle("FormCast");
		$form->addInput("Введите сообщение", "Введите сообщение, и его увидит весь сервер!");
		$form->sendToPlayer($s);
	}
}

?> 