# Guidebook > Quality Attributes

## Performance

The following pages are Key Transactions, and page loads will be completed in under 1 second.

- FH: Homepage
- FH: Browse Products
- FH: Search Products
- FH: View Product
- FH: Checkout

The following pages are Secondary Transactions, and page loads will be completed in under 2 seconds.

- FH: Manage Customer Account
- BH: Search Products
- BH: View Product
- BH: Search Orders
- BH: View Order

## Scalability

- FH will be able to handle 50 concurrent users whilst maintaining the above Performance criteria.
- FH will be able to handle 1000 Products whilst maintaining the above Performance criteria.
- BH will be able to handle 500 active Orders whilst maintaining the above Performance criteria.

## Availability

- Availability will be 99.9% (1m 26s downtime per day, to be targeted at scheduled maintenance windows)
- Scheduled Maintenance Windows will be used outside of the core Business hours.

## Security

- GDPR regulations sill be followed.
- Customer passwords will be stored using bcrypt only.
- Bcrypt will be handled by the built-in language functions only. No custom hashing functions are allowed.
- Internal credentials will never be stored in the source code.
- Authentication for FH and BH will be by email address and password.
- Customer data can be sanitised as per GDPR regulations. To maintain data integrity, the account will not be hard-deleted.
- FH and BH will be served by HTTPS connections.

## Extensibility

- The core SDR product will be extensible to cater for specific Business requirements.

## Flexibility

- Where multiple subsystems are available to fulfil the core requirements (payment gateways, stock management), the platform can be reconfigured to use a different provider.

## Auditing

An audit log will be available for the following actions:

- Create Customer
- Update Customer
- Create Order
- Update Order
- Create Product
- Update Product
- Login to FH
- Login to BH

## Monitoring and Management

Error reporting, speed performance and metrics will be handled by an external provider.

## Failover / Disaster Recovery

No Failover functionality is available. Data recovery is handled at infrastructure level.

## i18n / l10n

SDR will handle multiple languages and cultural expectations.

## Accessibility

FH and BH will follow the WCAG 2.1 standards.
