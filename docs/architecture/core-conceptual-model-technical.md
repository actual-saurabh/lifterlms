# Core Conceptual Model: Technical

A course means different things to different people in a different context. From a learner (and learning) centric approach, the course is what the learner experiences. There is a difference between what is presented to the learner vs what the learner experiences.

A learner could experience the same course multiple times and this experience could be different each time.

That is why the activity statements carry a reference to the state (as the object id) instead of the unit directly.

Technically, this means

* LMS loads a _Course Structure_.
* LMS chooses a `unit` from the _Course Structure_ to launch.
* LMS generates and stores a `state` (a custom object).
    >`state` includes a freshly generated `object_id` which _represents_ or is a _reference_ to the actual `unit`, This `object_id` is used by the `unit` as the `object_id` of all `statements` it creates.
* LMS launches `unit` and passes `state` to it.
    > So, it is always one `state` per `unit` launch (~ learner's attempt).
* `unit` presents the associated content.
* `unit` communicates back and forth with the LMS, as needed to fine-tune the content experience and available interactions.
* `unit` generates `statements` describing user activities.
* `unit` sends statements to LRS.
* LRS stores `states` and `statements`.
* LRS uses the composite information provided by `states` and `statements` to present reports and meaningful information.


