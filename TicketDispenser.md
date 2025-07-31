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
- Fix the initial unit test
    - This test is very fragile, because in case that there are tests that are executed before it, they would alter the final result incrementing the `turnNumber` making the result not constant

### Conclusions
