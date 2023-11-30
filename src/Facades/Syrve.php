<?php

namespace Neverlxsss\Syrve\Facades;

use Illuminate\Support\Facades\Facade;
use Neverlxsss\Syrve\Support\Response;

/**
 * Class SyrveFacade
 *
 * This facade provides a convenient way to interact with the Syrve API for various operations, including retrieving organizations, sending notifications, managing terminal groups, creating orders, and more.
 *
 * @method static Response organizations(bool $returnAdditionalInfo, bool $includeDisabled, array $returnExternalData = [], array $organizationIds = [])
 * @method static Response notifications(string $orderSource, string $orderId, string $additionalInfo, string $messageType, string $organizationId)
 * @method static Response terminalGroups(array $organizationIds, bool $includeDisabled = null, bool $returnExternalData = null)
 * @method static Response terminalGroupsIsAlive(array $terminalGroupIds, array $organizationIds)
 * @method static Response terminalGroupsAwake(array $organizationIds, array $terminalGroupIds)
 * @method static Response cancelCauses(array $organizationIds)
 * @method static Response orderTypes(array $organizationIds)
 * @method static Response discounts(array $organizationIds)
 * @method static Response paymentTypes(array $organizationIds)
 * @method static Response removalTypes(array $organizationIds)
 * @method static Response tipsTypes(array $organizationIds)
 * @method static Response menu(string $organizationId, int $startRevision = null)
 * @method static Response externalMenus(string $correlationId, array $externalMenus = [], array $priceCategories = [])
 * @method static Response externalMenuById(string $externalMenuId, array $organizationIds, string $priceCategoryId = null, string $version = null, string $language = null)
 * @method static Response outOfStock(array $organizationIds, bool $returnSize = false, array $terminalGroupsIds = [])
 * @method static Response outOfStockCheck(string $organizationId, string $terminalGroupId, array $items)
 * @method static Response combo(string $organizationId, bool $extraData = false)
 * @method static Response comboCalculate(string $organizationId, array $items)
 * @method static Response commandsStatus(string $organizationId, string $correlationId)
 * @method static Response availableRestaurantSections(array $terminalGroupIds, bool $returnSchema = false, ?int $revision = null)
 * @method static Response createOrder(string $organizationId, string $terminalGroupId, $order, array $createOrderSettings = [])
 * @method static Response getOrdersByTables(array $organizationIds, array $tableIds, array $sourceKeys = [], array $statuses = [], string $dateFrom, string $dateTo)
 * @method static Response webhooksSettings(string $organizationId)
 * @method static Response webhooksUpdateSettings(string $organizationId, string $webHooksUri, string $authToken = null, array $webhooksFilter = [])
 * @package Neverlxsss\Syrve\Facades
 */
class Syrve extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return 'syrve';
    }
}
