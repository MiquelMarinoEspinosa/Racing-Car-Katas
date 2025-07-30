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

### Conclusions
