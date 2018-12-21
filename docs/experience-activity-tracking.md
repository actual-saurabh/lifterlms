# Tracking Architecture: Experience & Activity Tracking

> **xAPI/cmi5 Specifications and LifterLMS** The concepts (mental models) discussed here are similar to the ones found in the [xAPI](https://github.com/adlnet/xAPI-Spec) and/or [cmi5](https://github.com/AICC/CMI-5_Spec_Current/blob/quartz/cmi5_spec.md) specifications.
>
>Compliance with the implementation part of these specifications is not our priority. We only seek to enhance LifterLMS with a flexible and granular tracking framework which can track, manage and report diverse types of learning activities. So we only borrow the mental models for a WordPress focused implementation instead.

## 1. Learning Experience

*Equivalent:*

| xAPI       | WordPress | Legacy LLMS                          |
|------------|-----------|--------------------------------------|
| Experience | - |  - |

### Introduction

The new architecture and API proposes to track a given user's complete Experience by recording every Activity performed by the user. In this sense, the term *Experience* can be understood as a collection of records of Activities performed. Within the context of LifterLMS, the term *Activity* is used for both the actual activity as well as it's record stored in the database.

### Object Model

### Database Structure

## 2. Learning Activity

*Equivalent:*

| xAPI       | WordPress | Legacy LLMS                          |
|------------|-----------|--------------------------------------|
| Activity Statement | - | - |


### Introduction

An Activity is made up of the following components

 * **Actor**: The individual or group that performed the activity.
 * **Verb**: Describes the kind of interaction between the Actor and the Object. Example: started, completed, passed, failed, etc
 * **Object**: The object that the Actor interacted with. Example: Lesson, Video, Quiz, Question, Task, etc. This is more readily understood as the *actual* activity versus the record of the activity that'sbeing described here.
 * **Context**: Describes the conditions and any other information relavant to the performance of the activity.
 * **Result**: If an activity leads to a measurable outcome, it can have a result component. Example: Score, Duration, Answer, etc

### Object Model

### Database Structure

## 3. Actor

*Equivalent:*

| xAPI       | WordPress | Legacy LLMS                          |
|------------|-----------|--------------------------------------|
| Actor | User |  Student |

### Introduction

Although an actor as of now is the same as a WordPress user and we could simply use the WP user ID for the actor column, it is proposed to create a separate table for actors to support unregistered visitors and groups in the future. As of now, the actor table will look like this

| actor_id | uuid | type | secondary_id |
| -------- | ---- | ---- | ------------ |
| MySQL autoincrement integer. This could be used as the default user identification by LifterLMS | for future xAPI compatibility | Group/ Individual/ Anonymous, etc | WP user id/ group id from group table/ anonymous user id from another mechanism, etc |


### Object Model

### Database Structure

## 4. Verb

*Equivalent:*

| xAPI       | WordPress | Legacy LLMS                          |
|------------|-----------|--------------------------------------|
| Verb | - | User-Post Meta (Status) |

### Introduction

1. **Registered** (indicates that the actor has registered to perform the activity. Example, enrollment)
 1. **Launched** (indicates that a particular activity was launched. Example, video)
 1. **Initialized** (indicates that a particular activity was completely initialised after launch. Sometimes, an activity may not get initialized after a launch. In that sense, initialization could be considered as a successful launch.)
 1. **Suspended** (indicates that a particular activity was paused or abandoned temporarily)
 1. **Completed** (indicating that a particular activity was completed)
 1. **Passed** (indicates that athe actor has passed)
 1. **Failed** (indicates that the actor has failed)
 1. **Abandoned** (indicating that a particular activity was abandoned)
 1. **Waived** (indicating that a particular activity was waived (because it was already completed in an alternative form))
 1. **Terminated** (indicating that a particular activity was terminated)
 1. **Satisfied**
 1. **Voided**


### Object Model

### Database Structure

## 5. Object

*Equivalent:*

| xAPI       | WordPress | Legacy LLMS                          |
|------------|-----------|--------------------------------------|
| Experience | Post | Course, Lesson, Quiz, Question, Achievement, etc |

### Introduction

### Object Model

### Database Structure

## 6. Context

*Equivalent:*

| xAPI       | WordPress | Legacy LLMS                          |
|------------|-----------|--------------------------------------|
| Context | Custom Object Metadata | Post Meta, User Meta, User-Post Meta |

### Introduction

```php

register_llms_context( 'context_key', $other_params );
```

### Object Model

### Database Structure
