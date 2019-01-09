# Course Structure

<!-- vscode-markdown-toc -->
* 1. [Thought Process](#ThoughtProcess)
	* 1.1. [Courses as Navigation Menus](#CoursesasNavigationMenus)
	* 1.2. [Sections as Collections & Sections as Blocks](#SectionsasCollectionsSectionsasBlocks)
	* 1.3. [Course as a Section](#CourseasaSection)
	* 1.4. [Course & Sections as Taxonomy](#CourseSectionsasTaxonomy)
	* 1.5. [Quizzes & Assignments as Sections (Taxonomy Terms)](#QuizzesAssignmentsasSectionsTaxonomyTerms)
	* 1.6. [Objectives & Units as Post Types](#ObjectivesUnitsasPostTypes)
		* 1.6.1. [Unit as a Collection](#UnitasaCollection)
	* 1.7. [Sections and Course Heirarchy](#SectionsandCourseHeirarchy)
	* 1.8. [Course vs Section](#CoursevsSection)
	* 1.9. [References, not Actuals](#ReferencesnotActuals)
* 2. [Actual Structure](#ActualStructure)

<!-- vscode-markdown-toc-config
	numbering=true
	autoSave=true
	/vscode-markdown-toc-config -->
<!-- /vscode-markdown-toc -->

##  1. <a name='ThoughtProcess'></a>Thought Process

###  1.1. <a name='CoursesasNavigationMenus'></a>Courses as Navigation Menus

Consider the fact that a course structure actually looks like menu, especially when presented as the syllabus or as an outline.

* WordPress uses a taxonomy called `'nav_menu'`. See: https://developer.wordpress.org/reference/functions/wp_get_nav_menu_object/
* Every menu created is a term of the taxonomy `'nav_menu'`.
* Menu items within a menu are post objects of a heirarchical custom post type called `'nav_menu_item'`. See: https://developer.wordpress.org/reference/functions/wp_get_nav_menu_items/
* Each `'nav_menu_item'` has three metas, `'object_id'`, `'object'`, `'type'`
    1. `'object'` refers to the kind of object that is referred to. It can be a `'term'` or `'post'`
    1. `'type'` refers to the available object types, `'taxonomy'` or `'post_type'`
    1. `'object_id'` refers to the actual `'term_id'` or `'post_id'`
    * This is the general language used elsewhere in WP. In other contexts `'object'` can be `'comment'` and `'type'` could be `'comment_type'`.
    * There is scope for extending this to include custom objects (I have used widgets as menu items).
* When loading a menu, WordPress needs a slug to identify the term and then get all post types by that term. See: https://developer.wordpress.org/reference/functions/wp_nav_menu/
* Each menu item is a separate post object allowing it to become a extremely flexible reference for any kind of object.

If we emulate this logic

* Use a taxonomy called `'course'`.
* Every course created is a term of the taxonomy `'course'`.
* All units become post objects of a heirachical custom post type called `'course_unit`'.
* Each `'course_unit'` has three metas, `'object_id'`, `'object'`, `'type'`
    * `'object'` refers to the kind of object that is referred to. It can be a `'term'` or `'post'`
    * `'type'` refers to the available object types, `'taxonomy'` or `'post_type'`
    * `'object_id'` refers to the actual `'term_id'` or `'post_id'`
    * Like navigation menu items, it could simply refer to an external link!
* When loading a course, LifterLMS needs a slug (or id) to identify the term and then get all post types by that term. See: https://developer.wordpress.org/reference/functions/wp_nav_menu/
* Each menu item is a separate post object allowing it to become a extremely flexible reference for any kind of object (events, products, attachment, etc).

###  1.2. <a name='SectionsasCollectionsSectionsasBlocks'></a>Sections as Collections & Sections as Blocks

Until now, sections, as the name suggests were understood as pieces of the course (section = to cut). *cmi5* calls such entities `blocks` (as in building blocks or components of a whole) and they are understood as a `collection` of `units`, `objectives` and other `sections`. In this sense the relationship between a `section` and a `course` is the same as that between a `block` and a WordPress `post` in 5.x.

###  1.3. <a name='CourseasaSection'></a>Course as a Section

In this sense, a `course` is also a `section` (or at least behaves like it) since it is also a `collection` of `units`, `objectives` and other `sections`.

From its `section` nature, a `course` also gets the traits of a `block`. This means that one course can be a `section` in another `course`. Or, you could create any level of organisation. The levels in this organisation could be called anything, be anything as long as it possesses the _attributes_ & _behaviour_ or what is technically called the **trait** of a section, it can do everything that a section can.

So, what constitutes a course is entirely upto the course creator.

A course could be a 3 year thing divided into `years`, `semesters`, `subjects`, `topics`, etc. Any of these could behave like a course and the levels below it will behave like sections.

###  1.4. <a name='CourseSectionsasTaxonomy'></a>Course & Sections as Taxonomy

A building block is a building block because it has a limited kind of independent existence, apart from being a part of the whole.

If it stays independent, it can be reused as a part of multiple wholes.

By that logic, both `posts` and `terms` would work. However, their other role is to serve as a collection of `units`(, `objectives` and other `sections`). That role is better fulfilled by a `term`, if the items in the collection are `posts`.

Like `courses`, `sections` also behave like navigation menus in their own right, especially if they need to be reusable. That's also another reason why they should be `terms`.

The relationship between `terms` in this case is complicated because it can happen across taxonomies. The relationship is derived from the Course Structure.

###  1.5. <a name='QuizzesAssignmentsasSectionsTaxonomyTerms'></a>Quizzes & Assignments as Sections (Taxonomy Terms)

Section behaviour for Quizzes & Assignments means they can be used outside courses. Any kind of learning experience is possible.

Second, they could exist outside a unit.

###  1.6. <a name='ObjectivesUnitsasPostTypes'></a>Objectives & Units as Post Types

> Objectives deserve special and detailed attention, elsewhere and later. Limiting this to Units

Units are leaf nodes, non-heirarchical in nature. Units also represent the state of a course (and a screen/URL in WordPress). Their primary purpose is to present content and interactions for learning (or associated activities like instruction/grading).

That is why `'unit'`is a custom `post_type`.

####  1.6.1. <a name='UnitasaCollection'></a>Unit as a Collection

A unit can also behave like a collection of activities represented by `blocks` that make up the unit content.

> Blocks are the way `sections` (and therefore `courses`) could be embedded inside an unit. An example is a quiz at the end of a post. Or a task checklist that works alongside a tutorial.

The collection behaviour of a unit is not a concern of the Course Structure. It is the concern of the Unit and uses WordPress blocks as components of a unit.

###  1.7. <a name='SectionsandCourseHeirarchy'></a>Sections and Course Heirarchy

Unlike builtin WordPress objects, the relationship between Sections and Course is a parent child relationship. Just as different `post_types` can have a parent-child relationship, it should be possible to have `course` terms to have parent-child relationships with `section` term.

###  1.8. <a name='CoursevsSection'></a>Course vs Section

Everything else being equivalent, the only difference between a `course` and a `section` is that a `course` is the _root_ node of a _tree data structure_,  `section` is a _node_ (and `unit` is the leaf).

Any other behaviour should be decoupled (like sales, drip, etc) from `courses` and `sections` and they should be free to behave the way they like.

###  1.9. <a name='ReferencesnotActuals'></a>References, not Actuals

The key thing to take away is that the Course Struture comprising of a single root level `term` of the taxonomy `course`, multiple nested `terms` of the taxonomy `section` and `posts` of the post_type `unit` all contain references to other terms or posts that form the actual content and its organisation.

`course`, `section` and `unit`, all have the following meta

* `'object'` refers to the kind of object that is referred to. It can be a `'term'` or `'post'`
* `'type'` refers to the available object types, `'taxonomy'` or `'post_type'`
* `'object_id'` refers to the actual `'term_id'` or `'post_id'`

The only limitation to keep in mind is that only `terms` can become a `course` or `section` and only `posts` can become a `unit`. The opportunity is that _any_ `term` of _any_ `taxonomy` can become a `course` or a `section` of a course and _any_ `post_type` can become a `unit`.

##  2. <a name='ActualStructure'></a>Actual Structure

> **@todo** Explore how reusable blocks work in WP, follow the same mental model

```js
{
    "id": WP_Term->ID, // term of taxonomy "course"
    "title": {
        "en-US": "This is a course title",
        "es-MX": "Se trata de un título del curso",
    },
    "description": {
        "en-US": "This is a course description",
        "es-MX": "Esta es una descripción del curso",
    },
    "object_id": { // makes this reusable, extendable & multilingual
        "en-US": WP_Term->ID,
        "es-MX": WP_Term->ID,
    }
    "object":      "term",
    "object_type":   WP_Term->taxonomy,
    "persona": [ "capability", "capability", "capability" ], //matched against launchdata
    "section" : {
        "id": WP_Post->ID, // post_type "section"
        "title": {
            "en-US": "This is the section title",
            "es-MX": "Este es el título del sección"
        },
        "description": {
                "en-US": "This is the section description",
                "es-MX": "Este es la descripción del sección",
        },
        "object_id": { /// makes this reusable, extendable & multilingual
          "en-US":  WP_Post->ID,
          "es-MX": WP_Post->ID
        },
        "object":      "term",
        "type":   WP_Term->taxonomy,
        "persona": [ "capability", "capability", "capability" ], //matched against launchdata
        "objective": {
            "id": WP_Post->ID, // post_type "objective"
            "title": {
                "en-US": "This is the objective title",
                "es-MX": "Este es el título del objetivo",
            },
            "description": {
                "en-US": "This is the objective description",
                "es-MX": "Esta es la descripción objetiva",
            },
            "object_id": { /// makes this reusable, extendable & multilingual
              "en-US":  WP_Post->ID,
              "es-MX": WP_Post->ID
              }
            },
            "object":      post, term, comment, object,
            "object_type":   WP_Post->post_type, WP_Term->taxonomy,

        }, // objective
        "unit": {
            "id": WP_Post->ID, // post_type "unit"
            "launch_method": "own_window", "any_window",
            "mastery_score": 0-1,
            "move_on": "passed", "completed", "completed_and_passed", "completed_or_passed", "not_applicable",
            "title": {
                "en-US": "This is a unit title.",
                "es-MX": "Este es un título de la unidad."
            }
            "description": {
                    "en-US": "This is the unit description",
                    "es-MX": "Esta es la descripción de la unidad",
                },
            "objective": {
                "id",
                "title": {
                    "en-US": "This is the objective title",
                    "es-MX": "Este es el título del objetivo",
                },
                "description": {
                    "en-US": "This is the objective description",
                    "es-MX": "Esta es la descripción objetiva",
                },
            }, // objective
            "url":, // in case it is an external URL
            "launch_parameters": Custom_Object,
            "persona": [ "capability", "capability", "capability" ], //matched against launchdata
            "object_id": { /// makes this reusable, extendable & multilingual
              "en-US":  WP_Post->ID,
              "es-MX": WP_Post->ID
            },
            "object":      post, term, comment, object,
            "type":   WP_Post->post_type, WP_Term->taxonomy, WP_Comment->comment_type, Custom_Object->sub_type,
        } // unit
    } // section
} // course
```
