## Unit Tests
### Create purchase test:
-Tests the creation of a purchase.
-Send a POST request to /create-purchase.
- Check if the response has the status code 200, if it is JSON, and if it contains the message and Purchase_id keys.

## List Shopping Test:
- Test the shopping list.
- Send a GET request to /list-purchases.
- Check if the response has the status code 200, if it is JSON, and if it contains the purchasing key.
- Update Purchase Status Test:

### Tests updating the status of a purchase.
- Simulates the creation of a purchase to obtain the ID.
- Send a PUT request to /update-purchase-status/{$purchaseId}/{$newStatus}.
- Check that the response has the status code 200, is JSON, and contains the message key.

*Aplying in Test-Driven Development (TDD)*

knplabs/knp-paginator-bundle
