# AGENTS.md

## BrainPath Guest Recommendation Prototype

### Objective

Implement a lightweight guest recommendation flow without modifying the Machine Learning service.

The goal is to allow users to try the career recommendation feature before login/register while preserving the existing authenticated workflow.

This is an experimental branch implementation and must not break the current production flow.

---

# Project Structure

This workspace contains three separate repositories:

```text
brainpath-workspace/
├── brainpath-frontend/
├── brainpath-backend/
└── brainpath-ml/
```

Each repository has its own Git history and must remain independent.

Do NOT merge repositories.

---

# Repository Rules

## Frontend

Repository:

```text
brainpath-frontend
```

Technology:

```text
Vue 3
Vite
Pinia
Vue Router
```

Allowed modifications:

```text
YES
```

---

## Backend

Repository:

```text
brainpath-backend
```

Technology:

```text
Laravel
Sanctum
SQLite/MySQL
```

Allowed modifications:

```text
YES
```

---

## Machine Learning

Repository:

```text
brainpath-ml
```

Technology:

```text
FastAPI
```

Allowed modifications:

```text
NO
```

The ML repository may only be inspected to understand the existing API contract.

Do not modify any ML code.

Do not create new ML endpoints.

Do not change ML response structures.

---

# Current Architecture

Current flow:

```text
Frontend
↓
Laravel Backend
↓
FastAPI ML Service
↓
Laravel Backend
↓
Frontend
```

Current recommendation endpoint:

```text
GET /api/recommendations
```

Current recommendation flow requires authentication because:

```php
$user = Auth::user();
```

is used inside:

```php
RecommendationController@index()
```

The controller currently depends on:

```php
$user->interest
$user->progress()
$user->id
RecommendationLog::create(...)
```

Therefore the current recommendation endpoint cannot be directly used for guest users.

---

# Guest Flow Goal

Desired flow:

```text
Landing
↓
Onboarding
↓
Interest Form
↓
Guest Recommendation
↓
Recommendation Result
↓
Optional Login/Register
```

Login should only be required for:

```text
Saving progress
Dashboard
History
Profile
Chatbot
Course progress
Admin pages
```

---

# Important Constraint

This is a prototype branch.

Do not replace existing authenticated logic.

Do not remove current onboarding flow.

Do not remove current recommendation flow.

Only add a parallel guest flow.

---

# Backend Tasks

Repository:

```text
brainpath-backend
```

---

## Step 1

Inspect existing recommendation implementation.

Files:

```text
app/Http/Controllers/Api/RecommendationController.php
routes/api.php
```

Understand how Laravel communicates with FastAPI.

Do not modify ML service.

---

## Step 2

Create a new public endpoint.

File:

```text
routes/api.php
```

Add:

```php
Route::post(
    'guest/recommendations',
    [RecommendationController::class, 'guest']
);
```

This endpoint must remain outside:

```php
Route::middleware('auth:sanctum')
```

---

## Step 3

Create a new controller method:

```php
guest(Request $request)
```

inside:

```text
RecommendationController.php
```

This method must NOT use:

```php
Auth::user()
$request->user()
$user->progress()
$user->id
```

Guest users do not exist in the database.

---

## Step 4

Accept payload from frontend:

```json
{
  "has_it_knowledge": true,
  "interest": "backend, ai",
  "learning_goal": "Build personal projects",
  "note": "Interested in web development"
}
```

---

## Step 5

Reuse existing logic:

```php
INTEREST_SEARCH_MAP
INTEREST_CATEGORY_MAP
```

Build query title using guest interests.

---

## Step 6

Reuse existing FastAPI endpoint.

Current ML contract must remain unchanged.

The guest endpoint should still call:

```text
ML_SERVICE_URL/api/v1/recommend
```

using the same request format already used by Laravel.

---

## Step 7

Do not create recommendation logs.

Do not insert records into:

```text
recommendation_logs
```

Guest users do not have:

```php
user_id
```

---

## Step 8

If ML returns empty results, reuse existing fallback logic:

```php
Course::where(...)
```

using mapped category.

---

# Frontend Tasks

Repository:

```text
brainpath-frontend
```

---

## Step 1

Inspect current routes:

```text
src/router/index.js
```

---

## Step 2

Make these pages public:

```text
/onboarding
/reframing
/interest-form
/recommendation
```

Remove:

```js
meta.requiresAuth
```

only from these routes.

---

## Step 3

Keep protected routes unchanged:

```text
/dashboard
/profile
/history
/chatbot
/resources/:id
/admin/*
```

---

## Step 4

Inspect onboarding store:

```text
src/stores/onboardingStore.js
```

Current method:

```js
completeOnboarding()
```

must remain unchanged.

---

## Step 5

Create a new method:

```js
getGuestRecommendation()
```

This method should:

1. Build onboarding payload.
2. Call:

```js
POST /guest/recommendations
```

3. Store recommendation result.

Example:

```js
guestRecommendation
```

inside Pinia state.

---

## Step 6

Persist guest result using:

```js
localStorage
```

to survive page refresh.

Example key:

```text
guest_recommendation
```

---

## Step 7

Update:

```text
InterestForm.vue
```

Logic:

```js
if (authStore.isAuthenticated) {
    await onboardingStore.completeOnboarding()
} else {
    await onboardingStore.getGuestRecommendation()
}
```

---

## Step 8

Update:

```text
Recommendation.vue
```

Recommendation page must support:

### Authenticated User

Current flow:

```text
/api/recommendations
```

### Guest User

Use:

```js
onboardingStore.guestRecommendation
```

or:

```js
localStorage
```

---

## Step 9

If guest result does not exist:

Redirect to:

```text
/interest-form
```

or show empty state.

---

## Step 10

Show CTA after guest recommendation:

```text
Save your progress?
```

Buttons:

```text
Login
Register
```

Guest users should see recommendations before authentication.

---

# Acceptance Criteria

Guest users can:

```text
Access onboarding
Access interest form
Generate recommendations
View recommendations
```

without login.

---

Authenticated users can still:

```text
Login
Complete onboarding
Receive recommendations
Access dashboard
Access history
Access profile
```

without regression.

---

ML service remains untouched.

---

# Do Not Do

Do not modify:

```text
brainpath-ml
```

Do not remove current auth flow.

Do not rewrite onboarding flow.

Do not modify database schema unless absolutely necessary.

Do not convert dashboard/history/profile into public pages.

Do not log guest recommendations.

Do not create guest users in database.

---

# Development Strategy

Work only on:

```text
feature/guest-recommendation
```

or equivalent experimental branch.

This feature must be evaluated before any merge into main branches.

