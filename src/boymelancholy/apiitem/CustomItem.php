<?php

namespace boymelancholy\apiitem;

use pocketmine\block\Block;
use pocketmine\entity\Entity;
use pocketmine\item\Item;
use pocketmine\item\ItemIdentifier;
use pocketmine\player\Player;

abstract class CustomItem extends Item
{
    /** @var array<string, mixed> */
    public static array $customItemData = [];

    public function __construct(int $id, $meta = 0)
    {
        $strArray = explode("\\", static::class);
        $name = end($strArray);

        parent::__construct(new ItemIdentifier($id, $meta), $name);
        $this->setCustomName($this->getItemName());
        $this->setLore($this->getItemLore());
    }

    /**
     * Saved data
     * @param string $key
     * @return mixed
     */
    public function getItemData(string $key) : mixed
    {
        $key =  static::class.".".$key;
        $keys = explode(".", $key);
        $dat = self::$customItemData;
        for ($i = 0; $i < count($keys); ++$i) {
            if (isset($dat[$keys[$i]])) {
                $dat = &$dat[$keys[$i]];
            } else {
                return null;
            }
        }
        return $dat;
    }

    /**
     * Save data as key
     * @param string $key
     * @param mixed $data
     */
    public function setItemData(string $key, mixed $data)
    {
        $key =  static::class.".".$key;
        $keys = explode(".", $key);
        $dat = &self::$customItemData;
        for ($i = 0; $i < count($keys); ++$i) {
            $dat = &$dat[$keys[$i]];
            if ($i == count($keys) - 1) {
                $dat = $data;
            }
        }
    }

    /**
     * Unset data
     * @param string $key
     */
    public function unsetItemData(string $key)
    {
        $key =  static::class.".".$key;
        $keys = explode(".", $key);
        $dat = &self::$customItemData;
        for ($i = 0; $i < count($keys); ++$i) {
            $dat = &$dat[$keys[$i]];
            if ($i == count($keys) - 1) {
                unset($dat);
            }
        }
    }

    /**
     * Saved data per player
     * @param Player $player
     * @param string $key
     * @return mixed
     */
    public function getItemPlayerData(Player $player, string $key) : mixed
    {
        return $this->getItemData($player->getName().".".$key);
    }

    /**
     * Save data as key per player
     * @param Player $player
     * @param string $key
     * @param mixed $data
     */
    public function setItemPlayerData(Player $player, string $key, mixed $data)
    {
        $this->setItemData($player->getName().".".$key, $data);
    }

    /**
     * Unset data per player
     * @param Player $player
     * @param null|string $key
     */
    public function unsetItemPlayerData(Player $player, ?string $key = null)
    {
        $this->unsetItemData(match ($key) {
            null => $player->getName(),
            default => $player->getName().".".$key
        });
    }

    /**
     * Custom name
     * @return string
     */
    abstract public function getItemName() : string;

    /**
     * Item lore
     * @return array
     */
    abstract public function getItemLore() : array;

    /**
     * Trigger when player use this item.
     * @param Player $player
     */
    public function onItemUse(Player $player)
    {
    }

    /**
     * Trigger when player left click anywhere with this item.
     * @param Player $player
     * @param Block $block
     */
    public function onLeftClick(Player $player, Block $block)
    {
    }

    /**
     * Trigger when player right click anywhere with this item.
     * @param Player $player
     * @param Block $block
     */
    public function onRightClick(Player $player, Block $block)
    {
    }

    /**
     * Trigger when player held this item.
     * @param Player $player
     */
    public function onItemHeld(Player $player)
    {
    }

    /**
     * Trigger when player move with this item.
     * @param Player $player
     */
    public function onMove(Player $player)
    {
    }

    /**
     * Trigger when player is sneaking with this item.
     * @param Player $player
     * @param bool $isSneaking
     */
    public function onToggleSneak(Player $player, bool $isSneaking)
    {
    }

    /**
     * Trigger when player is flying with this item.
     * @param Player $player
     * @param bool $isFlying
     */
    public function onToggleFlight(Player $player, bool $isFlying)
    {
    }

    /**
     * Trigger when player is swimming with this item.
     * @param Player $player
     * @param bool $isSwimming
     */
    public function onToggleSwim(Player $player, bool $isSwimming)
    {
    }

    /**
     * Trigger when player is sprinting with this item.
     * @param Player $player
     * @param bool $isSprinting
     */
    public function onToggleSprint(Player $player, bool $isSprinting)
    {
    }

    /**
     * Trigger when player touch entity with this item.
     * @param Player $player
     * @param Entity $entity
     */
    public function onEntityInteract(Player $player, Entity $entity)
    {
    }

    /**
     * Trigger when player drop this item.
     * @param Player $player
     */
    public function onDropItem(Player $player)
    {
    }

    /**
     * Trigger when player consume this item.
     * @param Player $player
     */
    public function onItemConsume(Player $player)
    {
    }

    /**
     * Trigger when player jump with this item.
     * @param Player $player
     */
    public function onJump(Player $player)
    {
    }

    /**
     * Trigger when player attack to entity with this item.
     * @param Player $player Attacker
     * @param Entity $entity Defender
     */
    public function onAttack(Player $player, Entity $entity)
    {
    }
}