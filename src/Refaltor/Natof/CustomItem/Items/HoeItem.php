<?php

/*
 *     /$$$$$$$           /$$               /$$
 *   | $$__  $$         | $$              | $$
 *   | $$  \ $$/$$$$$$ /$$$$$$   /$$$$$$ /$$$$$$   /$$$$$$  /$$$$$$  /$$$$$$$
 *   | $$$$$$$/$$__  $|_  $$_/  |____  $|_  $$_/  /$$__  $$/$$__  $$/$$_____/
 *   | $$____| $$  \ $$ | $$     /$$$$$$$ | $$   | $$  \ $| $$$$$$$|  $$$$$$
 *   | $$    | $$  | $$ | $$ /$$/$$__  $$ | $$ /$| $$  | $| $$_____/\____  $$
 *   | $$    |  $$$$$$/ |  $$$$|  $$$$$$$ |  $$$$|  $$$$$$|  $$$$$$$/$$$$$$$/
 *   |__/     \______/   \___/  \_______/  \___/  \______/ \_______|_______/
 *
 *  GNU General Public License v2.0
 *  Copyright (C) 1989, 1991 Free Software Foundation, Inc.
 *  51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA
 *  Everyone is permitted to copy and distribute verbatim copies
 *  of this license document, but changing it is not allow
 */

namespace Refaltor\Natof\CustomItem\Items;

use pocketmine\block\Block;
use pocketmine\block\BlockFactory;
use pocketmine\block\BlockLegacyIds;
use pocketmine\item\Armor;
use pocketmine\item\ArmorTypeInfo;
use pocketmine\item\Axe;
use pocketmine\item\Hoe;
use pocketmine\item\Item;
use pocketmine\item\ItemIdentifier;
use pocketmine\item\ItemUseResult;
use pocketmine\item\Pickaxe;
use pocketmine\item\Sword;
use pocketmine\item\TieredTool;
use pocketmine\item\ToolTier;
use pocketmine\math\Vector3;
use pocketmine\player\Player;
use pocketmine\Server;

class HoeItem extends Hoe
{
    /** @var string  */
    private string $texturePath;

    /** @var int */
    private int $creativeCategory = 3;

    /** @var float  */
    private float $damageTools;

    /** @var float  */
    private float $durability;

    public function __construct(ItemIdentifier $identifier, string $name, ToolTier $tier, float $damageTools, float $durability)
    {
        $this->durability = $durability;
        $this->damageTools = $damageTools;
        $this->texturePath = 'barrier';
        parent::__construct($identifier, $name, $tier);
    }

    public function getMaxDurability(): int
    {
        return $this->durability;
    }


    /**
     * @param string $path
     * @return $this
     */
    public function setTexture(string $path): self {
        $this->texturePath = $path;
        return $this;
    }

    /**
     * @return string
     */
    public function getTexture(): string {
        return $this->texturePath;
    }

    public function getAttackPoints(): int
    {
        return $this->damageTools; // TODO: Change the autogenerated stub
    }

    public function onInteractBlock(Player $player, Block $blockReplace, Block $blockClicked, int $face, Vector3 $clickVector): ItemUseResult
    {
        if(in_array($blockClicked->getId(), [BlockLegacyIds::DIRT, BlockLegacyIds::GRASS]) && $face == 1){
            $player->getWorld()->setBlock($blockClicked, BlockFactory::getInstance()->get(BlockLegacyIds::FARMLAND));
        }

        return ItemUseResult::SUCCESS();
    }

    /**
     * @return string
     */
    public function getCreativeCategory(): string {
        return $this->creativeCategory;
    }
}