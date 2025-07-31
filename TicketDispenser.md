## Exercise notes
### Goal
- write unit test for [TicketDispense](./src/TurnTicketDispenser/TicketDispenser.php)

### Initial test/coverage status
- There is a failing unit test that needed to be fixed
- However, the full class is covered with a `100%`

### Code first insights
- There is a `inline static method` which makes difficult to unit test the `TicketDispenser` class

### SOLID principle violated
- `DIP - depency inversion principle` is violated

### Initial strategy
- Since the method is `static`, there is no way that this situation could be solved injecting the dependency
- One option would be adding an extra optional paramter to the `getTurnedTicketMethod` to pass it from outside
    - No clear whether that would be a good idea
- Here there are different stratgies to test the class
    - Integration tests
        - Just test executing the current code
        - Use `reflection` to mock the `TurnNumberSequence` value
        - Introduce a setter to the `TurnNumberSequence` to override the value
        - We are going to achieve the 100% coverage
    - Unit test
        - extract the inline static method into a `protected` method and override it wiht a `fake class`
        - the `protected` method will remain uncovered for this test

### Notes
- Integration
    - Fix the initial integration test
        - This test is very fragile, because in case that there are tests that are executed before it, they would alter the final result incrementing the `turnNumber` making the result not constant
    - Implements the `reflection` integration test
    - Implement `setter` at the `TurnNumberSequence`
    - The only approach which achieved `100%` coverage is the `setter` approach because is the only one that uses the `getter` and `setter` methods at `TurnNumberSequence`
- Unit test
    - Extract inline static method into a `protected method` and mock that protected method via a
        - `partial mock`
        - `fake test`
- Create a `TurnNumberSequenceProxy` to encapsulate the `TurnNumberSequence`
    - Instantiate the class inline in the `TicketDispenser __construct` method
    - Inject the proxy as an optional parameter at the `TicketDispenser __construct` method
    - Remove partial mock unit test
    - Mock proxy at the `fake class`
    - Remove the `fake class` at the `unit test` and `unit test` the real class
    - Inline the `nextTurn` method in the `TicketDispenser`

### Conclusions
- The code can be covered `100%` with `integration tests`
    - The most conservative and may be ideal approach would be use `reflection` to override the `turnNumber` value
- The code cannot be `100%` covered by `unit tests`
    - However, that would not be a problem, because the only part which is not covered is the static method call
    - `partial mock` would prevent us from creating a new `fake class`
    - Therefore it might be the ideal solution