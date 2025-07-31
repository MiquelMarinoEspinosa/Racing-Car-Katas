## Exercise notes
### Goal
- write unit test for [HtmlTextConverter](./src/TextConverter/HtmlTextConverter.php)

### Initial test/coverage status
- There is a failing test that just covered the `getFileNameMethod`
- The current coverage is `22.22%`

### Code first insights
- The code is coupled to system methods to read a file line by line
- It would be great to have some kind of file manager class which would be responsible of reading the file and just leave the logic to the class to format the content in html

### SOLID principle violated
- `SRP - single responsability principle`
    - The class not just format the content into html but also read files content coupling the class to the system calls

### Initial strategy
- Fix the current failing test
- Create unit test without faking the system calls
- Encapsualte sistem calls into protected method and override in a `fake class`
- Once the `100%` coverage has been reached, reafactor the code introducing a new class that would manage the file access
    - Add the class as an optional paramater at the `HtmlTextConverter __construct` method
- Make the parameter mandatory simulating an ideal scenario

### Notes
- Fix the initial unit test
- Create unit test to cover `convertToHtml`
    - An `integration` test has been created with an empty file and it worked
        - The `coverage` has increased up to `66.67%`
    - Another `integration` test has been created with a line with html special caracters
        - The `coverage` has increased up to `100%`
- Extract `fopen` in an `private method` at the `HtmlTextConverter` class
- Extract `fgets` system call into a private method at the `HtmlTextConverter` class
- Create a `fake class` and test the empty file case
- Test not empty file with the `fake class`
- Remove integration tests
    - The coverage is reduced because the `fopen` and `fgets` are not covered with the `fake class` approach
    - These methods will be relocated to a new external class in order to enhance the `SRP`
- Refactor `fake class` removing boolean text processed status and add file path to the path unit test
- Create class `FileTextManager` and implement `fopen` and `fgets`
    - `fopen` implemented and used in the `HtmlTextConverter`
    - use `fgets` `FileTextManager class` in `HtmlTextConverter`
- Mock `FileTextManager` in the `fake class`
    - mock `fopen` and remove `fopen` method override
    - mock `fgets` and remove `fgets` method

### Conclusions
