# apiitem
pmmp virion about custom item

# Load
```php
/** @var PluginBase $plugin */
CustomItemFactory::load($plugin);
```

# Sample: MagicRod
### Register
```php
CustomItemFactory::register(new MagicRod(ItemIds::BLAZE_ROD));
```

### Send item to player
```php
$player->getInventory()->addItem(CustomItemFactory::get(MagicRod::class));
```

### sample class
```php
use boymelancholy\apiitem\CustomItem;
use pocketmine\player\Player;

class MagicRod extends CustomItem
{
    public function getItemName() : string
    {
        return "MagicRod";
    }

    public function getItemLore() : array
    {
        return [
            "Lore line 1",
            "Lore line 2",
            "Lore line 3",
            "Lore line 4"
        ];
    }
    
    public function onItemUse(Player $player)
    {
        $player->sendMessage("Use MagicRod!");
    }
}
```

# Require methods

|Method|Description|
|:---|:---|
|`getItemName()`|Display item name (CustomName)|
|`getItemLore()`|Display item lore (Lore)|

# Handle methods

|Method|Description|
|:---|:---|
|`onItemUse(Player $player)`|Trigger when player use this item.|
|`onLeftClick(Player $player, Block $block)`|Trigger when player left click anywhere with this item.|
|`onRightClick(Player $player, Block $block)`|Trigger when player right click anywhere with this item.|
|`onItemHeld(Player $player)`|Trigger when player held this item.|
|`onMove(Player $player)`|Trigger when player move with this item.|
|`onToggleSneak(Player $player, bool $isSneaking)`|Trigger when player is sneaking with this item.|
|`onToggleFlight(Player $player, bool $isFlying)`|Trigger when player is flying with this item.|
|`onToggleSwim(Player $player, bool $isSwimming)`|Trigger when player is swimming with this item.|
|`onToggleSprint(Player $player, bool $isSprinting)`|Trigger when player is sprinting with this item.|
|`onEntityInteract(Player $player, Entity $entity)`|Trigger when player touch entity with this item.|
|`onDropItem(Player $player)`|Trigger when player drop this item.|
|`onItemConsume(Player $player)`|Trigger when player consume this item.|
|`onJump(Player $player)`|Trigger when player jump with this item.|
|`onAttack(Player $player, Entity $entity)`|Trigger when player attack to entity with this item.|

# Useful methods
All methods below are per-item data storage methods for your convenience.  


|Method|Description|
|:---|:---|
|`getItemData(string $key)`|Get saved data|
|`setItemData(string $key, mixed $data)`|Save data as key|
|`unsetItemData(string $key)`|Unset data|
|`getItemPlayerData(Player $player, string $key)`|Get saved data per player|
|`setItemPlayerData(Player $player, string $key, mixed $data)`|Save data as key per player|
|`unsetItemPlayerData(Player $player, ?string $key = null)`|Unset data as key per player|