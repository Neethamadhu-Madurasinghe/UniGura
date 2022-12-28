# Unigura

## Naming
- new_directory
- ModelMyModel.php
- ControllerName.php
- viewName.php
- File_Helper.php
- css-file.css

## Git Flow
https://www.atlassian.com/git/tutorials/comparing-workflows/gitflow-workflow#:~:text=Gitflow%20is%20an%20alternative%20Git,lived%20branches%20and%20larger%20commits.

## Code checking
## Sonarlint
https://marketplace.visualstudio.com/items?itemName=SonarSource.sonarlint-vscode#:~:text=SonarLint%20for%20Visual%20Studio%20Code,the%20code%20is%20even%20committed.

### Setting up sonarlint
- SonarLint is enabled automatically once it's installed
- *This changes only for other projects that won't follow with Sonarlint cloud*
- Settings > Search "Sonarlint" > Select "SonarLint" under Tools > Select "Rules" > Search "Open curly"
Under languages we use, un-tick "An open curley braces should be located at the beginning of a line"

## SonarCloud 
SonarCloud will run some tests on each branch merge request. *It won't allow  merging until all tests are passed.*

See test results https://sonarcloud.io/summary/overall?id=Neethamadhu-Madurasinghe_UniGura
### Connecting SonarLint to SonarCloud
- Settings > Search "Sonarlint" > Settings > Goto section under SonarQube/SonarCloud connections
Add a new connection using "+" button > 
- Give the new connection a name > Click next > Add a new token > Next... Create > Setup node.exe path > Ok
- A popup will be appear at this point > Configure binding > Tick Bind project to SonarQube/SonarCloud > Select connection we mae earlier > Add Porject-key (Update local storage if needed) > Ok
