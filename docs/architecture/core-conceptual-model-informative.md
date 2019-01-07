# Core Conceptual Model: Informative

<!-- vscode-markdown-toc -->
* 1. [Pre-Learning Workflow](#Pre-LearningWorkflow)
* 2. [Interaction Workflow](#InteractionWorkflow)
* 3. [Reporting Workflow](#ReportingWorkflow)
* 4. [Appendices](#Appendices)
	* 4.1. [Learner Workflow](#LearnerWorkflow)
		* 4.1.1. [Pre-Learning](#Pre-Learning)
		* 4.1.2. [Learning](#Learning)
		* 4.1.3. [Reporting](#Reporting)
	* 4.2. [Instructor Workflow](#InstructorWorkflow)
		* 4.2.1. [Pre-Instruction](#Pre-Instruction)
		* 4.2.2. [Instruction](#Instruction)
		* 4.2.3. [Reporting](#Reporting-1)

<!-- vscode-markdown-toc-config
	numbering=true
	autoSave=true
	/vscode-markdown-toc-config -->
<!-- /vscode-markdown-toc -->

##  1. <a name='Pre-LearningWorkflow'></a>Pre-Learning Workflow
1. **LMS** loads/imports (Course) **Structure**
    1. (Course) **Structure** contains *references* to one or more **Units** organised into heirarchical **Sections**.
    * _References_ to Units, not actual Units. Sections are part of the Structure, Units aren't.
1. **Administrator** assigns appropriate Course specific **Roles** to other **Stakeholders**
    * *Example*: **Administrator** assigns **Course** to **Learner**
    * *Example*: **Learner** registers for **Course** trigerring automatic assignment.
    1. **LMS** creates personalised *instance*/*iteration* called a **Journey** from **Structure**
    1. **LMS** assigns **Role** based **Capabilities** to **Stakeholders**
        * *Example:* **LMS** assigns **Journey** to **Learner**
        * **Capabilities** cover possible interactions and report viewing.

##  2. <a name='InteractionWorkflow'></a>Interaction Workflow

Includes Learning, Learning Management and Instruction

1. **Stakeholder** *authenticates* with **LMS**
1. **Stakeholder** receives **Capabilities**
1. **Stakeholder** requests interaction with **Unit** from **LMS**
1. **LMS** launches **Session** with **State** Information
1. **LMS** writes **State** to **LRS**
1. **Unit** requests **State** information from **LMS**
1. **Unit** loads (Unit) **Content**
1. **Stakeholder** interacts with **Content**
1. **Unit** sends and requests *information* relevant to the *interaction** to and from **LMS**
1. **LMS** generates **Statements** describing **Stakeholder** interaction using *information* received from **Unit**
1. **Stakeholder** exits **Unit**
1. **Unit** sends final tracking data.
1. **Unit** issues a **terminate** statement.
1. **LMS** writes generated statements to **LRS**

##  3. <a name='ReportingWorkflow'></a>Reporting Workflow

1. **LRS** retreives and presents *information* from stored **Statements** as **Reports**
1. **Administrator** create and view ***Reports** from stored **Statements**
1. **Stakeholders** view **Reports** based on **Capabilities**

##  4. <a name='Appendices'></a>Appendices

###  4.1. <a name='LearnerWorkflow'></a>Learner Workflow

####  4.1.1. <a name='Pre-Learning'></a>Pre-Learning

1. (**Learner** authenticates with **LMS**.)
1. **Learner** requests **LMS** for assignment of **Course** (= Learner registers for Course):
    1. **LMS** assigns pre-generated **Journey** to **Learner**.
    1. **Learner** receives pre-defined **Capabilities**.

####  4.1.2. <a name='Learning'></a>Learning

1. **Learner** requests launch of **Unit** from **LMS**
1. **LMS** launches **State**
1. **LMS** records **State** into **LRS**
1. **LMS** launches **Unit** after validating authentication and capabilities
1. **Unit** loads **State** from LMS
1. **Unit** loads Unit **Content**
1. **Learner** interacts with **Content**
1. **Unit** interacts with **LMS**
1. **LMS** records **Statements** into **LRS**

####  4.1.3. <a name='Reporting'></a>Reporting

1. **Learner** requests **Report** from **LRS**
1. **LRS** requests authentication from **LMS**
1. **LRS** requests **Capabilities** from **LMS**
1. **LRS** displays **Report**

###  4.2. <a name='InstructorWorkflow'></a>Instructor Workflow

####  4.2.1. <a name='Pre-Instruction'></a>Pre-Instruction

1. **Adminsitrator** assigns **Instructor** role to **User**
    1. **LMS** assigns pre-generated **Journeys** of one or more **Learner** to **Instructor**.
    1. **Instructor** receives pre-defined **Capabilities**.
1. (**Instructor** authenticates with **LMS**.)

####  4.2.2. <a name='Instruction'></a>Instruction

1. **Instructor** requests launch of **Unit** from **LMS**
1. **LMS** launches **State**
1. **LMS** records **State** into **LRS**
1. **LMS** launches **Unit** after validating authentication and capabilities
1. **Unit** loads **State** from LMS
1. **Unit** loads Unit **Content**
1. **LMS** **Statements** for one or more **Learners**
1. **Instructor** interacts with **Unit**
1. **Instructor** interacts with **Statements**
1. **Unit** interacts with **LMS**
1. **LMS** records **Statements** into **LRS**

####  4.2.3. <a name='Reporting-1'></a>Reporting

1. **Instructor** requests **Report** from **LRS**
1. **LRS** requests authentication from **LMS**
1. **LRS** requests **Capabilities** from **LMS**
1. **LRS** displays **Report**


