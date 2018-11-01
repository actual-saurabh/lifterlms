# Core Abstractions for LD Professionals and Developers

All higher level concepts in LifterLMS like courses, lessons, quizzes, etcx are basically more detailed implementations of a few lower level abstractions. If you can express your unit of learning using these abstractions, you can integrate it with LifterLMS easily.

## Activity

An activity is anything that a user does on your site, irrespective of whether it is relevant to learning or marketing (or LifterLMS).

LifterLMS provides a lot of activities (like quiz questions, assignment tasks, lessons, etc) that your users can participate in or perform. Other activities may be provided by other plugins or by WordPress core itself.

## Experience

An experience is a record of a user's participation in or performance of an activity.

## Objective

An objective is an expected participation in or performance of an activity.

### Objective Taxonomy

Objectives can be organised and labeled by built-in (skill tags, skill categories, etc) or custom taxonomies.

## Milestone

A milestone is a special, highlighted experience with markers.

### Milestone Marker

A marker is an object (event, thing) that marks a milestone like a label, badge, certificate, email, physical letter, etc

## Sequence (~Path)

A sequence is a collection of objectives (and/or other sequences) that need to be completed in a particular order (synchronous) or in any order (asynchronous). In addition to being a collection of objectives, a sequence also behaves like an objective.

> Not sure if path is a more appropriate term for this.

## Plan

A plan is a top level collection of objectives and/or sequences. It is also an objective by itself.

### Plan Taxonomy

Plans can be organised and labeled by built-in (course tags, course categories, etc) or custom taxonomies.

## Journey

A journey is a planned or unplanned series of experiences leading to completion of objectives, with highlighted milestones along the way.

(Plan >> Objective) >> Activity >> Experience >> Milestone >> Journey

## Tree Structure

| Data Tree | Low Level Abstractions | High Level Abstractions |
| --------: | :--------------------: | :---------------------- |
| Root | Plan | Course |
| Node | Sequence | Section |
| Leaf | Objective | Lesson |
