<?php

namespace boymelancholy\apiitem\listener;

use boymelancholy\apiitem\CustomItem;
use boymelancholy\apiitem\CustomItemFactory;
use pocketmine\block\Air;
use pocketmine\event\entity\EntityDamageByEntityEvent;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerDropItemEvent;
use pocketmine\event\player\PlayerEntityInteractEvent;
use pocketmine\event\player\PlayerInteractEvent;
use pocketmine\event\player\PlayerItemConsumeEvent;
use pocketmine\event\player\PlayerItemHeldEvent;
use pocketmine\event\player\PlayerItemUseEvent;
use pocketmine\event\player\PlayerJumpEvent;
use pocketmine\event\player\PlayerMoveEvent;
use pocketmine\event\player\PlayerQuitEvent;
use pocketmine\event\player\PlayerToggleFlightEvent;
use pocketmine\event\player\PlayerToggleSneakEvent;
use pocketmine\event\player\PlayerToggleSprintEvent;
use pocketmine\event\player\PlayerToggleSwimEvent;
use pocketmine\player\Player;

class ItemListener implements Listener
{
    /**
     * @param PlayerItemUseEvent $event
     * @priority LOW
     * @ignoreCanceled true
     */
    public function onUse(PlayerItemUseEvent $event)
    {
        $item = $event->getItem();
        if ($item instanceof CustomItem) {
            $item->onItemUse($event->getPlayer());
        }
    }

    /**
     * @param PlayerInteractEvent $event
     * @priority LOW
     * @ignoreCanceled true
     */
    public function onInteract(PlayerInteractEvent $event)
    {
        $item = $event->getItem();
        $block = $event->getBlock();
        if ($block instanceof Air) return;
        if ($item instanceof CustomItem) {
            switch ($event->getAction()) {
                case $event::LEFT_CLICK_BLOCK:
                    $item->onLeftClick($event->getPlayer(), $block);
                    break;

                case $event::RIGHT_CLICK_BLOCK:
                    $item->onRightClick($event->getPlayer(), $block);
                    break;
            }
        }
    }

    /**
     * @param PlayerItemHeldEvent $event
     * @priority LOW
     * @ignoreCanceled true
     */
    public function onHeld(PlayerItemHeldEvent $event)
    {
        $item = $event->getItem();
        if ($item instanceof CustomItem) {
            $item->onItemHeld($event->getPlayer());
        }
    }

    /**
     * @param PlayerMoveEvent $event
     * @priority LOW
     * @ignoreCanceled true
     */
    public function onMove(PlayerMoveEvent $event)
    {
        $item = $event->getPlayer()->getInventory()->getItemInHand();
        if ($item instanceof CustomItem) {
            $item->onMove($event->getPlayer());
        }
    }

    /**
     * @param PlayerToggleSneakEvent $event
     * @priority LOW
     * @ignoreCanceled true
     */
    public function onSneak(PlayerToggleSneakEvent $event)
    {
        if (!$event->isSneaking()) return;
        $item = $event->getPlayer()->getInventory()->getItemInHand();
        if ($item instanceof CustomItem) {
            $item->onToggleSneak($event->getPlayer(), $event->isSneaking());
        }
    }

    /**
     * @param PlayerToggleFlightEvent $event
     * @priority LOW
     * @ignoreCanceled true
     */
    public function onFlight(PlayerToggleFlightEvent $event)
    {
        if (!$event->isFlying()) return;
        $item = $event->getPlayer()->getInventory()->getItemInHand();
        if ($item instanceof CustomItem) {
            $item->onToggleFlight($event->getPlayer(), $event->isFlying());
        }
    }

    /**
     * @param PlayerToggleSwimEvent $event
     * @priority LOW
     * @ignoreCanceled true
     */
    public function onSwim(PlayerToggleSwimEvent $event)
    {
        if (!$event->isSwimming()) return;
        $item = $event->getPlayer()->getInventory()->getItemInHand();
        if ($item instanceof CustomItem) {
            $item->onToggleSwim($event->getPlayer(), $event->isSwimming());
        }
    }

    /**
     * @param PlayerToggleSprintEvent $event
     * @priority LOW
     * @ignoreCanceled true
     */
    public function onSprint(PlayerToggleSprintEvent $event)
    {
        if (!$event->isSprinting()) return;
        $item = $event->getPlayer()->getInventory()->getItemInHand();
        if ($item instanceof CustomItem) {
            $item->onToggleSprint($event->getPlayer(), $event->isSprinting());
        }
    }

    /**
     * @param PlayerJumpEvent $event
     * @priority LOW
     * @ignoreCanceled true
     */
    public function onJump(PlayerJumpEvent $event)
    {
        $item = $event->getPlayer()->getInventory()->getItemInHand();
        if ($item instanceof CustomItem) {
            $item->onJump($event->getPlayer());
        }
    }

    /**
     * @param PlayerEntityInteractEvent $event
     * @priority LOW
     * @ignoreCanceled true
     */
    public function onTapEntity(PlayerEntityInteractEvent $event)
    {
        $item = $event->getPlayer()->getInventory()->getItemInHand();
        if ($item instanceof CustomItem) {
            $item->onEntityInteract($event->getPlayer(), $event->getEntity());
        }
    }

    /**
     * @param PlayerDropItemEvent $event
     * @priority LOW
     * @ignoreCanceled true
     */
    public function onDropItem(PlayerDropItemEvent $event)
    {
        $item = $event->getItem();
        if ($item instanceof CustomItem) {
            $item->onDropItem($event->getPlayer());
        }
    }

    /**
     * @param PlayerItemConsumeEvent $event
     * @priority LOW
     * @ignoreCanceled true
     */
    public function onConsume(PlayerItemConsumeEvent $event)
    {
        $item = $event->getItem();
        if ($item instanceof CustomItem) {
            $item->onItemConsume($event->getPlayer());
        }
    }

    /**
     * @param EntityDamageByEntityEvent $event
     * @priority LOW
     * @ignoreCanceled true
     */
    public function onDamageByEntity(EntityDamageByEntityEvent $event)
    {
        $player = $event->getDamager();
        if ($player instanceof Player) {
            $item = $player->getInventory()->getItemInHand();
            if ($item instanceof CustomItem) {
                $item->onAttack($player, $event->getEntity());
            }
        }
    }

    /**
     * @param PlayerQuitEvent $event
     * @priority LOW
     * @ignoreCanceled true
     */
    public function onQuit(PlayerQuitEvent $event)
    {
        foreach (CustomItemFactory::getAll() as $item) {
            $item->unsetItemPlayerData($event->getPlayer());
        }
    }
}