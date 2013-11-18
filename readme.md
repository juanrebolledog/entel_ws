# Entel Events REST API

## Resources

### Benefits

Benefits endpoint.
Base URL: /api/benefits

#### GET /

Benefit index endpoint. Will accept coordinates to filter the benefits it will give out.

Parameters:

 - lat
 - lng

Example:

https://api.example.com/api/benefits?lat=10.1234&lng=-69.2134

### GET /ranking

Benefit ranking endpoint. Will return a Benefit list sorted by user rating.

Example:

https://api.example.com/api/benefits/ranking

### POST /{benefit_id}/vote

Benefit voting endpoint. Will return true on success.

Example:

https://api.example.com/api/benefits/1/vote

#### GET /{benefit_id}

Benefit info endpoint. Will give out the info for a specific benefit. Also includes BenefitMedia records.

Example:

https://api.example.com/api/benefits/1

#### GET /search

Benefit search endpoint. Will accept a keyword query string to filter.

Parameters:

 - q

Example:

https://api.example.com/api/benefits/search?q=Text+search

#### POST /{benefit_id}/ignore

Benefit ignore endpoint. Will make a specific benefit hidden to the current user

Example:

https://api.example.com/api/benefits/1/ignore

### Events

Events endpoint.
Base URL: /api/events

#### GET /

Event index endpoint. Will accept coordinates to filter the events it will give out.

Parameters:

 - lat
 - lng

Example:

https://api.example.com/api/events?lat=10.1234&lng=-69.1234

#### GET /{event_id}

Event info endpoint. Will give out the info for a specific event. Also includes EventMedia records.

Example:

https://api.example.com/api/events/1

#### GET /search

Event search endpoint. Will accept a keyword query string to filter.

Parameters:

 - q

Example:

https://api.example.com/api/events/search?q=Text+search

#### POST /{event_id}/ignore

Event ignore endpoint. Will make a specific event hidden to the current user

Example:

https://api.example.com/api/events/1/ignore

### POST /{event_id}/vote

Event voting endpoint. Will return true on success.

Example:

https://api.example.com/api/events/1/vote

### Users

Users endpoint.
Base URL: /api/users

#### GET /profile

User profile endpoint. Will give out user's profile info.

Example:

https://api.example.com/api/users/profile

#### GET /{user_id}

User info endpoint. Will give out the user's public profile info.

Example:

https://api.example.com/api/users/1

### GET /unlocked

Unlocked bonus benefits endpoint. Will give out which bonus benefits the user has unlocked.

Example:

https://api.example.com/api/users/unlocked

### GET /achievements

Achievement list endpoint. Returns a list of user unlocked achievements by participation or content generation.

Example:

https://api.example.com/api/users/achievements

#### POST /

User registration endpoint. Will receive user data to register. On success the response will contain the apikey to use in all api communication.

Example:

https://api.example.com/api/users/register

#### PUT /{user_id}

User update endpoint. Will receive user data to update a record. Only the owner or admin can perform this action.

Example:

https://api.example.com/api/users/1

#### DELETE /{user_id}

User deletion endpoint. Will delete a user record only if the requester is an admin or is the same user.

Example:

https://api.example.com/api/users/1

### Categories

Event/Benefit Categories endpoint.
Base URL: /api/categories

#### GET /

Categories index endpoint. Will give out all categories.

Example:

https://api.example.com/api/categories

#### GET /{category_id}

Category info endpoint. Will give out info on a specific category, including associated Benefits and Events.

Example:

https://api.example.com/api/categories/1