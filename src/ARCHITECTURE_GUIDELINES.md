## 1️⃣ Repository Layer Rules
- A repository **must return a model, a collection of models, or `null`**.
- A repository **must not throw exceptions** if a record is not found.
- A repository **must only interact with the database** (no business logic).
- Query results should be **simple and optimized** for performance.

✅ **Example**
```php
public function findById(int $id): ?Post
{
    return Post::find($id);
}
``` 
## 2️⃣ Service Layer Rules
- A service **must validate and handle null values** from repositories. 
- If an entity is required but not found, an **exception must be thrown**. 
- A service **must return DTOs or domain objects** (not raw models). 
- A service **must not call database** queries directly (always use repositories).

✅ Example

```php
public function getPostById(int $id): PostDTO
{
    $post = $this->postRepository->findById($id);
    
    if (!$post) {
        throw new PostNotFoundException("Post with ID $id not found");
    }
    return PostDTO::fromModel($post);
}
```
## 3️⃣ Controller Rules

- A controller must only handle HTTP requests and responses.
- A controller must not contain business logic.
- A controller must handle exceptions from services and return appropriate HTTP responses.


## 🆎 Queue Naming Convention

🔹 Methods that add tasks to the queue should start with enqueue

    ✅ enqueueMovieImport() – Adds movie import to the queue.

    ✅ enqueueUserNotification() – Queues a user notification.

    ✅ enqueueOrderProcessing() – Queues order processing.
