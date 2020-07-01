<?php declare(strict_types=1);

namespace FastBillSdk\Expense;

use FastBillSdk\Api\ApiClientInterface;
use FastBillSdk\Common\MissingPropertyException;
use FastBillSdk\Common\XmlService;

class ExpenseService
{
    /**
     * @var ApiClientInterface
     */
    private $apiClient;

    /**
     * @var XmlService
     */
    private $xmlService;

    /**
     * @var ExpenseValidator
     */
    private $validator;

    public function __construct(ApiClientInterface $apiClient, XmlService $xmlService, ExpenseValidator $validator)
    {
        $this->apiClient = $apiClient;
        $this->xmlService = $xmlService;
        $this->validator = $validator;
    }

    /**
     * @return ExpenseEntity[]
     */
    public function getExpense(ExpenseSearchStruct $searchStruct): array
    {
        $this->xmlService->setService('expense.get');
        $this->xmlService->setFilters($searchStruct->getFilters());
        $this->xmlService->setLimit($searchStruct->getLimit());
        $this->xmlService->setOffset($searchStruct->getOffset());

        $response = $this->apiClient->post($this->xmlService->getXml());

        $xml = new \SimpleXMLElement((string) $response->getBody());
        $results = [];
        foreach ($xml->RESPONSE->EXPENSES->EXPENSE as $expenseEntry) {
            $results[] = new ExpenseEntity($expenseEntry);
        }

        return $results;
    }

    public function createExpense(ExpenseEntity $entity): ExpenseEntity
    {
        $this->checkErrors($this->validator->validateRequiredCreationProperties($entity));

        $this->xmlService->setService('expense.create');
        $this->xmlService->setData($entity->getXmlData());

        $response = $this->apiClient->post($this->xmlService->getXml());

        $xml = new \SimpleXMLElement((string) $response->getBody());

        $entity->invoiceId = $xml->RESPONSE->INVOICE_ID;

        return $entity;
    }

    private function checkErrors(array $errorMessages): void
    {
        if (!empty($errorMessages)) {
            throw new MissingPropertyException(implode("\n", $errorMessages));
        }
    }
}
