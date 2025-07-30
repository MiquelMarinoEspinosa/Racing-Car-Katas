## Exercise notes
### Goal
- It is required to add unit tests to the [Alarm class](./src/TirePressureMonitoring/Alarm.php)

### Initial test/coverage status
- Currently an [AlarmTest](./tests/TirePressureMonitoring/AlarmTest.php) unit test is created
    - It checks the `isAlarmOn` method once the alarm has just been created
    - It does not test the `check` public method
- The current class coverage is `40.00%` and the only methods covered are the `__construct` and the `isAlarmOn`
    - In case of the `isAlarmOn` method, the method returns a boolean. Meaning, that the method could have 2 results - either `true` or `false`. The current test just check that the alarm is off. Important to notice that, even the method has been covered by a test, not all the business logic have necessarily been tested

### Code first insights
- At the `__construct` can be found that another class is inline instantiated, the [Sensor](./src/TirePressureMonitoring/Sensor.php)
- The sensor provides some values used by the `check` method to determine the `alarm` status
- In the current code status, it is going to be complicated to add more coverage to the class, particulary to the `check` method, since the `Sensor` values are random. Therefore, the unit test for these method would be also random making the test fragile
- The `Sensor` class should be mocked or faked somehow in order to returned fix values for each test

### SOLID principle violated
- I would say that clearly the `DIP - dependency inversion principle` is violated in this case
- The solution would be so inject the `Sensor` at the `Alarm` construct as a dependency. This way the code would be easier to test

### Initial strategy
- Write an initial test which test the `check` method to confirm the randomness of the method
- Implement a `fake class` to override the `Alarm sensor field` with a `mock` with constanc values
- Once the `check` method has been fully covered, refactor the `Alarm` class to inject the `Sensor` class in the construct and remove the `fake class` to test the `Alarm` class instead

### Notes
- Refactor `testFoo` unit test name
- Create an initial test for the `check` method which should not turn the alarm on
    - Unfortunatelly, as expected, the code returns random results regarding the alarm status when the test is executed
    - At this point some refactor needed to be done in order to make the `Sensor` return the desirable values to be able to test the business logic
- Create a `fake class` to override the `Sensor` values mocking the `Sensor` class
    - Create `FakeAlarm` class and extend it from the `Alarm` class
    - Inject the `Sensor` to the `FakeAlarm`
    - Break `Alarm` encapsulation to be able to override the the `sensor` field
    - Mock the `Sensor` at the `AlarmTest` `check method` unit test