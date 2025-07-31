## Exercise notes
### Goal
- write unit test for [HtmlTextConverter](./src/TelemetrySystem/TelemetryDiagnosticControls.php)

### Initial test/coverage status
- There is an empty test marked as incomplete
- Therefore, the code coverage is `0%`

### Code first insights
- There is a class called `TelemetryClient` instante it inlince in the `TelemetryDiagnosticControls __construct` method
- With the current implementation, the `TelemetryClient` cannot be mocked
- An strategy should be followed in order to mock this class

### SOLID principle violated
- `DIP - dependency inversion principle` because the `TelemetryClient` should be injected

### Initial strategy
- A `unit test` without mocks would be created
    - It is expected to randomly fail
- Use a `fake class` to override the `TelemetryClient`
    - A `setter` would work too
- Finally, once the `100%` coverage has been reached, inject `TelemetryClient` into `TelemetryDiagnosticControls`

### Notes
- Create an initial unit test without mocking the `TelemetryClient`
    - As expected, the unit test randomly failed, because the `TelemetryClient` return random resonpes
- Create a `fake class` strategy
    - It could also be done with a `setter` method
    - mock the client to fail
    - mock the client to succed
- Inject the `TelemetryClient` as an optional protected dependency at the `TelemetryDiagnosticControls`
- Replace the `fake class` for the `real class` and remove the `fake class`
- Make the `TelemetryClient` dependency mandatory and private

### Conclusions
- The `DIP` violation has been solved injecting the `TelemetryClient` as a dependency to make it mockable
- The strategy followed has been create a `fake class`
- Once the business logic has fully been covered, the `fake class` has been replaced for the real class injecting the dependency