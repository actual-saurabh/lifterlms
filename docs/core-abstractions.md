# Core Abstractions for LD Professionals and Developers

All higher level concepts in LifterLMS like courses, lessons, quizzes, etcx are basically more detailed implementations of a few lower level abstractions. If you can express your unit of learning using these abstractions, you can integrate it with LifterLMS easily.

## Activity

An activity is anything that a user does on your site, irrespective of whether it is relevant to learning or marketing (or LifterLMS).

LifterLMS provides a lot of activities (like quiz questions, assignment tasks, lessons, etc) that your users can participate in or perform. Other activities may be provided by other plugins or by WordPress core itself.

Any activity that can generate an experience can be integrated with LifterLMS. LifterLMS powered activities will obviously generate experiences. Additionally, probably via addons, LifterLMS could integrate with any other WordPress functionality (core or from plugins), third party APIs, etc.

## Experience

An experience is a record of a user's participation in or performance of an activity.

Experiences are used for progress tracking and for reporting. An experience looks like this

```json

{
  'activity_id'   : '8d9ff4b8-3897-4469-8038-2d2d5e92f866',
  'timestamp'     : 1541085357
  'actor_id'      : 'c6dd6d01-df84-4901-b58b-ba8e62c8afbc',
  'session_id'    : 'cb3868ef-3ee0-45dc-8d7e-3ace383cd2d0',
  'verb'          : 'completed',
  'object_id'     : '4995a1be-d4a7-4b32-85f6-3f5275c545fc',
  'object_type'   : 'post',
  'object_subtype': 'lesson',
  'objective_id'  : '0e713b09-9c7b-4282-b4a1-6dcfe30798fe',
  'context'       : {
    // stored in experience meta
    'result': {
      'score' : 0.9,
      'raw'   : 180,
      'min'   : 0,
      'max'   : 200
    },
  }

}

```

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
