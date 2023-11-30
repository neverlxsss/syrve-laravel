<?php

namespace Neverlxsss\Syrve;

use Neverlxsss\Syrve\Support\Method;
use Neverlxsss\Syrve\Support\Syrve as AbstractSyrve;
use Neverlxsss\Syrve\Support\Response;

/**
 *
 */
class Syrve
{
    protected AbstractSyrve $client;

    public function __construct()
    {
        try {
            $this->client = new AbstractSyrve(config('syrve.token'));
        } catch (\Exception) {
            throw new \RuntimeException("Bad token");
        }
    }

    /**
     * Returns organizations available to api-login user.
     *
     * @param bool  $returnAdditionalInfo
     * @param bool  $includeDisabled
     * @param array $returnExternalData
     * @param array $organizationIds
     *
     * @return \Neverlxsss\Syrve\Support\Response
     */
    public function organizations(
        bool $returnAdditionalInfo,
        bool $includeDisabled,
        array $returnExternalData = [],
        array $organizationIds = []
    ): Response {
        $response = $this->client->api(
            "/api/1/organizations",
            Method::POST->value,
            [],
            [
                'organizationIds'      => $organizationIds,
                'returnAdditionalInfo' => $returnAdditionalInfo,
                'includeDisabled'      => $includeDisabled,
                'returnExternalData'   => $returnExternalData,
            ]
        );

        return $response;
    }

    /**
     * Send notification to external systems (Syrve POS and Syrve App).
     *
     * @param string $orderSource
     * @param string $orderId
     * @param string $additionalInfo
     * @param string $messageType
     * @param string $organizationId
     *
     * @return \Neverlxsss\Syrve\Support\Response
     */
    public function notifications(
        string $orderSource,
        string $orderId,
        string $additionalInfo,
        string $messageType,
        string $organizationId
    ): Response {
        $response = $this->client->api(
            "/api/1/notifications/send",
            Method::POST->value,
            [],
            [
                'orderSource'    => $orderSource,
                'orderId'        => $orderId,
                'additionalInfo' => $additionalInfo,
                'messageType'    => $messageType,
                'organizationId' => $organizationId,
            ]
        );

        return $response;
    }

    /**
     * Method that returns information on groups of delivery terminals.
     *
     * @param array     $organizationIds
     * @param bool|null $includeDisabled
     * @param bool|null $returnExternalData
     *
     * @return \Neverlxsss\Syrve\Support\Response
     */
    public function terminalGroups(
        array $organizationIds,
        bool $includeDisabled = null,
        bool $returnExternalData = null
    ): Response {
        $response = $this->client->api(
            "/api/1/terminal_groups",
            Method::POST->value,
            [],
            [
                'organizationIds'    => $organizationIds,
                'includeDisabled'    => $includeDisabled,
                'returnExternalData' => $returnExternalData,
            ]
        );

        return $response;
    }

    /**
     * Returns information on availability of group of terminals.
     *
     * @param array $terminalGroupIds
     * @param array $organizationIds
     *
     * @return \Neverlxsss\Syrve\Support\Response
     */
    public function terminalGroupsIsAlive(array $terminalGroupIds, array $organizationIds): Response
    {
        $response = $this->client->api(
            "/api/1/terminal_groups/is_alive",
            Method::POST->value,
            [],
            [
                'terminalGroupIds' => $terminalGroupIds,
                'organizationIds'  => $organizationIds,
            ]
        );

        return $response;
    }

    /**
     * Awake terminal groups from sleep mode.
     *
     * @param array $organizationIds
     * @param array $terminalGroupIds
     *
     * @return \Neverlxsss\Syrve\Support\Response
     */
    public function terminalGroupsAwake(array $organizationIds, array $terminalGroupIds): Response
    {
        $response = $this->client->api(
            "/api/1/terminal_groups/awake",
            Method::POST->value,
            [],
            [
                'organizationIds'  => $organizationIds,
                'terminalGroupIds' => $terminalGroupIds,
            ]
        );

        return $response;
    }

    /**
     * Delivery cancel causes.
     *
     * @param array $organizationIds
     *
     * @return \Neverlxsss\Syrve\Support\Response
     */
    public function cancelCauses(array $organizationIds): Response
    {
        $response = $this->client->api(
            "/api/1/cancel_causes",
            Method::POST->value,
            [],
            [
                'organizationIds' => $organizationIds,
            ]
        );

        return $response;
    }

    /**
     * Order types.
     *
     * @param array $organizationIds
     *
     * @return \Neverlxsss\Syrve\Support\Response
     */
    public function orderTypes(array $organizationIds): Response
    {
        $response = $this->client->api(
            "/api/1/deliveries/order_types",
            Method::POST->value,
            [],
            [
                'organizationIds' => $organizationIds,
            ]
        );

        return $response;
    }

    /**
     * Discounts / surcharges.
     *
     * @param array $organizationIds
     *
     * @return \Neverlxsss\Syrve\Support\Response
     */
    public function discounts(array $organizationIds): Response
    {
        $response = $this->client->api(
            "/api/1/discounts",
            Method::POST->value,
            [],
            [
                'organizationIds' => $organizationIds,
            ]
        );

        return $response;
    }

    /**
     * Payment types.
     *
     * @param array $organizationIds
     *
     * @return \Neverlxsss\Syrve\Support\Response
     */
    public function paymentTypes(array $organizationIds): Response
    {
        $response = $this->client->api(
            "/api/1/payment_types",
            Method::POST->value,
            [],
            [
                'organizationIds' => $organizationIds,
            ]
        );

        return $response;
    }

    /**
     * Removal types (reasons for deletion).
     *
     * @param array $organizationIds
     *
     * @return \Neverlxsss\Syrve\Support\Response
     */
    public function removalTypes(array $organizationIds): Response
    {
        $response = $this->client->api(
            "/api/1/removal_types",
            Method::POST->value,
            [],
            [
                'organizationIds' => $organizationIds,
            ]
        );

        return $response;
    }

    /**
     * Get tips types for api-login`s rms group.
     *
     * @param array $organizationIds
     *
     * @return \Neverlxsss\Syrve\Support\Response
     */
    public function tipsTypes(array $organizationIds): Response
    {
        $response = $this->client->api(
            "/api/1/tips_types",
            Method::POST->value,
            [],
            [
                'organizationIds' => $organizationIds,
            ]
        );

        return $response;
    }

    /**
     * Menu.
     *
     * @param string   $organizationId
     * @param int|null $startRevision
     *
     * @return \Neverlxsss\Syrve\Support\Response
     */
    public function menu(string $organizationId, int $startRevision = null): Response
    {
        $response = $this->client->api(
            "/api/1/nomenclature",
            Method::POST->value,
            [],
            [
                'organizationId' => $organizationId,
                'startRevision'  => $startRevision,
            ]
        );

        return $response;
    }

    /**
     * External menus with price categories.
     *
     * @param string $correlationId
     * @param array  $externalMenus
     * @param array  $priceCategories
     *
     * @return \Neverlxsss\Syrve\Support\Response
     */
    public function externalMenus(
        string $correlationId,
        array $externalMenus = [],
        array $priceCategories = []
    ): Response {
        $response = $this->client->api(
            "/api/2/menu",
            Method::POST->value,
            [],
            [
                'correlationId'   => $correlationId,
                'externalMenus'   => $externalMenus,
                'priceCategories' => $priceCategories,
            ]
        );

        return $response;
    }

    /**
     * Retrieve external menu by ID.
     *
     * @param string      $externalMenuId
     * @param array       $organizationIds
     * @param string|null $priceCategoryId
     * @param string|null $version
     * @param string|null $language
     *
     * @return \Neverlxsss\Syrve\Support\Response
     */
    public function externalMenuById(
        string $externalMenuId,
        array $organizationIds,
        string $priceCategoryId = null,
        string $version = null,
        string $language = null
    ): Response {
        $response = $this->client->api(
            "/api/2/by_id",
            Method::POST->value,
            [],
            [
                'externalMenuId'  => $externalMenuId,
                'organizationIds' => $organizationIds,
                'priceCategoryId' => $priceCategoryId,
                'version'         => $version,
                'language'        => $language,
            ]
        );

        return $response;
    }

    /**
     * Out-of-stock items.
     *
     * @param array $organizationIds
     * @param bool  $returnSize
     * @param array $terminalGroupsIds
     *
     * @return \Neverlxsss\Syrve\Support\Response
     */
    public function outOfStock(array $organizationIds, bool $returnSize = false, array $terminalGroupsIds = []): Response
    {
        $response = $this->client->api(
            "/api/1/stop_lists",
            Method::POST->value,
            [],
            [
                'organizationIds'  => $organizationIds,
                'returnSize' => $returnSize,
                'terminalGroupsIds' => $terminalGroupsIds,
            ]
        );

        return $response;
    }

    /**
     * Check items in out-of-stock list.
     *
     * @param string $organizationId
     * @param string $terminalGroupId
     * @param array  $items
     *
     * @return \Neverlxsss\Syrve\Support\Response
     */
    public function outOfStockCheck(string $organizationId, string $terminalGroupId, array $items): Response
    {
        $response = $this->client->api(
            "/api/1/stop_lists/check",
            Method::POST->value,
            [],
            [
                'organizationId'  => $organizationId,
                'terminalGroupId' => $terminalGroupId,
                'items' => $items,
            ]
        );

        return $response;
    }

    /**
     * Get combos info
     *
     * @param string $organizationId
     * @param bool   $extraData
     *
     * @return \Neverlxsss\Syrve\Support\Response
     */
    public function combo(string $organizationId, bool $extraData = false): Response
    {
        $response = $this->client->api(
            "/api/1/combo",
            Method::POST->value,
            [],
            [
                'organizationId'  => $organizationId,
                'extraData' => $extraData,
            ]
        );

        return $response;
    }

    /**
     * Calculate combo price
     *
     * @param string $organizationId
     * @param array  $items
     *
     * @return \Neverlxsss\Syrve\Support\Response
     */
    public function comboCalculate(string $organizationId, array $items): Response
    {
        $response = $this->client->api(
            "/api/1/combo/calculate",
            Method::POST->value,
            [],
            [
                'organizationId'  => $organizationId,
                'items' => $items,
            ]
        );

        return $response;
    }

    /**
     * Get status of command.
     *
     * @param string $organizationId
     * @param string $correlationId
     *
     * @return \Neverlxsss\Syrve\Support\Response
     */
    public function commandsStatus(string $organizationId, string $correlationId): Response
    {
        $response = $this->client->api(
            "/api/1/commands/status",
            Method::POST->value,
            [],
            [
                'organizationId'  => $organizationId,
                'correlationId' => $correlationId,
            ]
        );

        return $response;
    }

    /**
     * Returns all restaurant sections of specified terminal groups, for which banquet/reserve booking are available.
     *
     * @param array    $terminalGroupIds $
     * @param bool     $returnSchema
     * @param int|null $revision         $
     *
     * @return \Neverlxsss\Syrve\Support\Response
     */
    public function availableRestaurantSections(array $terminalGroupIds, bool $returnSchema = false, ?int $revision = null): Response
    {
        $response = $this->client->api(
            "/api/1/reserve/available_restaurant_sections",
            Method::POST->value,
            [],
            [
                'terminalGroupIds'  => $terminalGroupIds,
                'returnSchema' => $returnSchema,
                'revision' => $revision,
            ]
        );

        return $response;
    }

    /**
     * Create order.
     *
     * @param string $organizationId
     * @param string $terminalGroupId
     * @param        $order
     * @param array  $createOrderSettings
     *
     * @return \Neverlxsss\Syrve\Support\Response
     */
    public function createOrder(string $organizationId, string $terminalGroupId, $order, array $createOrderSettings = []): Response
    {
        $response = $this->client->api(
            "/api/1/order/create",
            Method::POST->value,
            [],
            [
                'organizationId'  => $organizationId,
                'terminalGroupId' => $terminalGroupId,
                'order' => $order,
                'createOrderSettings' => $createOrderSettings,
            ]
        );

        return $response;
    }

    /**
     * Retrieve orders by tables.
     *
     * @param array  $organizationIds
     * @param array  $tableIds
     * @param array  $sourceKeys
     * @param array  $statuses
     * @param string $dateFrom
     * @param string $dateTo
     *
     * @return \Neverlxsss\Syrve\Support\Response
     */
    public function getOrdersByTables(array $organizationIds, array $tableIds, array $sourceKeys = [], array $statuses = [], string $dateFrom = null, string $dateTo = null): Response
    {
        $response = $this->client->api(
            "/api/1/order/by_table",
            Method::POST->value,
            [],
            [
                'organizationIds'  => $organizationIds,
                'tableIds' => $tableIds,
                'sourceKeys' => $sourceKeys,
                'statuses' => $statuses,
                'dateFrom' => $dateFrom,
                'dateTo' => $dateTo,
            ]
        );

        return $response;
    }

    /**
     * Get webhooks settings for specified organization and authorized API login.
     *
     * @param string $organizationId
     *
     * @return \Neverlxsss\Syrve\Support\Response
     */
    public function webhooksSettings(string $organizationId): Response
    {
        $response = $this->client->api(
            "/api/1/webhooks/settings",
            Method::POST->value,
            [],
            [
                'organizationId'  => $organizationId,
            ]
        );

        return $response;
    }

    /**
     * Update webhooks settings for specified organization and authorized API login.
     *
     * @param string      $organizationId
     * @param string      $webHooksUri
     * @param string|null $authToken
     * @param array       $webhooksFilter
     *
     * @return \Neverlxsss\Syrve\Support\Response
     */
    public function webhooksUpdateSettings(string $organizationId, string $webHooksUri, string $authToken = null, array $webhooksFilter = []): Response
    {
        $response = $this->client->api(
            "/api/1/webhooks/update_settings",
            Method::POST->value,
            [],
            [
                'organizationId' => $organizationId,
                'webHooksUri' => $webHooksUri,
                'authToken' => $authToken,
                'webhooksFilter' => $webhooksFilter,
            ]
        );

        return $response;
    }
}
