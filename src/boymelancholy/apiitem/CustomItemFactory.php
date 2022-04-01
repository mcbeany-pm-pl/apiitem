<?php

namespace boymelancholy\apiitem;

use boymelancholy\apiitem\listener\ItemListener;
use pocketmine\item\ItemFactory;
use pocketmine\plugin\PluginBase;
use pocketmine\Server;

class CustomItemFactory
{
    /** @var array<CustomItem> */
    private static array $customItems = [];

    /**
     * Load this api
     * @param PluginBase $pluginBase
     */
    public static function load(PluginBase $pluginBase)
    {
        Server::getInstance()->getPluginManager()->registerEvents(new ItemListener(), $pluginBase);
    }

    /**
     * Register custom item you made
     * @param CustomItem $customItem
     */
    public static function register(CustomItem $customItem)
    {
        ItemFactory::getInstance()->register($customItem);
        self::$customItems[$customItem::class] = $customItem;
    }

    /**
     * Get custom item from class name
     * @param string $className
     * @return CustomItem|null
     */
    public static function get(string $className) : ?CustomItem
    {
        if (isset(self::$customItems[$className])) {
            return self::$customItems[$className];
        }
        return null;
    }

    /**
     * Get all custom item
     * @return array<CustomItem>
     */
    public static function getAll() : array
    {
        return self::$customItems;
    }
}