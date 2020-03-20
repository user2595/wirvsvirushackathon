# WE vs virus hackathon

[Hackathon website](https://wirvsvirushackathon.org/) 

[Registration until 14:00](https://4germany.typeform.com/to/SaffK5)

[Technical Guide](https://wirvsvirushackathon.org/leitfaden/)

[FAQ](https://wirvsvirushackathon.org/faq/) 

EXPIRY 20.03.2020
* 14:00 - EMAILS FROM THE HACKATHON @ REGISTERED PARTICIPANTS
* 16:00 - Slack access by organizer
* 18:00  - Team Sign-Up 
* 19:30 - Start

### Note
This is a first draft and will be built and improved by the contributing team until a working prototype is ready.

_Also, the Documentation itself is to be implemented properly in a wiki. As mentioned, this is a draft to get the team started and everyone on board._

## Project: Online form for the health authority [GESUNDHEITSAMT] to pre-sort suspected cases of Corona

### 1. the idea
An online form is to be designed, which will allow a rough estimate of the actual cause of a suspected Covid-19 infection. In addition, a system is to be developed that will enable the health authorities to contact the suspected cases and to make concrete appointments to determine who can be tested in hospital/at home and when.

### 2. Use of the idea
* people can be presorted
* no sufficient test resources 
* possible carriers do not have to drive through half the city and endanger themselves and others
* long waiting times are avoided through appointements 
* Data on potential suspicious cases can be collected, which can also be evaluated afterwards
* better overview of the current spread in the country, especially with regard to mild trends
* contacting people afterwards who could not be tested at first and follow the spread of immunity in the population
* informing Concerned citizens in a targeted manner and receive concrete recommendations for behaviour
* follow-up questionnaires around by e.g. e-mail about how their symptoms have changed or whether more people in their environment have become infected

### 3. Short

* Front-end: online form, further action for patients & information
* Backend: Evaluation of data, appointment allocation, communication channel

### 4. General requirements
The online form should cover as many [factors](https://www.rki.de/DE/Content/InfAZ/N/Neuartiges_Coronavirus/Massnahmen_Verdachtsfall_Infografik_Tab.html 
) as possible which would substantiate or defuse a suspicion 

### 5. TO BE FILLED -> FORM ITSELF 

### 6.1 Useful functionalities

#### Core functionalities:
* Collecting the data, perhaps in an excel-table-like structure
* Pre-sorting of suspected cases by urgency
* Sending automatic replies to the cases that cannot be tested 
* System with which appointments can be efficiently allocated in hospitals

#### Which could be added later:
* Tools for statistical data evaluation with which you can easily create beautiful graphics
* Tools for data export
* Tools to design and send automatic questionnaires on the course of the disease in people who cannot be tested, and to send up-to-date information on the situation to the e-mail addresses provided

### 6.2 Backend requirements

* the weighting used to determine who gets a test should be easily adjustable, as the situation may change quickly
* possibility to add new columns quickly, e.g. if you want to start sending out online questionnaires on the course of the disease, the answers from the online questionnaires should then be easy to enter in the table
* Extension with statistical data evaluation tools 

### 6.3 Suggestion of how it could look like, for example

#### Data:
* Create data in an Excel spreadsheet structure
* one line for each suspected case
* The columns contain the respective item from the questionnaire and additional information
  * e.g. how important it is to test the person
  * whether the person has already received an automatic answer
  * whether the person has received an appointment , at the hospital, a personal visit from the health authority
  * column in which the appointments are entered
  * whether the person has already been tested or not 
  * if tested, what the test result was, etc.
  
* It would probably be practical if data could be sorted by the individual columns
* easiest way would probably be to have a separate column for the test dates, in which the dates are first directly assigned. * employee of the public health department could confirm the appointments manually 
  * then: an email will be sent, or the people who have not given an email address could be called
* It would probably also be good if people with severe symptoms / a particularly high risk of a severe course of disease were specially marked, so that the people from the health department can then contact these people directly. 

#### Example 

Time of receipt | Last Name | First Name | Riskgroup?  | Appointement | Tested? |  Adress | Mail/Phone
------------ | ------------- | ------------- | ------------- | ------------  | ------------- | ------------- | -------------
01.04.2020, 10:00 | Mustermann | Max | Yes | None | No | Heidestr. 17, 51147 Koeln | m.m@mmann.net
.... | .... | .... | .... | .... | .... | .... | .... 

_Note pinkerpirat: This should be discussed further since GDPR violation can be easily done here._

### Authors

* Anna-Kathrina - Idea & Text
* [Tarik](https://github.com/user2595) 
* [pinkerpirat](https://github.com/pinkerpirat) - English Version/ README
* Anja 
* [rknntns](https://github.com/rknntns)

### Contributers  

_List will be completed on 23rd March 2020_

