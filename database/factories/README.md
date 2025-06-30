# Famplan Factories

This directory contains Laravel factories for generating realistic test data for the Famplan application.

## Available Factories

### 1. FamilyFactory

Generates family data with realistic names and settings.

**Usage:**

```php
// Create a single family
$family = Family::factory()->create();

// Create multiple families
$families = Family::factory(5)->create();

// Create inactive family
$inactiveFamily = Family::factory()->inactive()->create();

// Create family with minimal settings
$minimalFamily = Family::factory()->minimal()->create();
```

### 2. FamilyMemberFactory

Generates family member data with different roles.

**Usage:**

```php
// Create a parent
$parent = FamilyMember::factory()->parent()->create();

// Create a child
$child = FamilyMember::factory()->child()->create();

// Create a guardian
$guardian = FamilyMember::factory()->guardian()->create();

// Create inactive member
$inactiveMember = FamilyMember::factory()->inactive()->create();
```

### 3. ChoreFactory

Generates household chores with realistic data.

**Usage:**

```php
// Create daily chores
$dailyChores = Chore::factory(5)->daily()->create();

// Create weekly chores
$weeklyChores = Chore::factory(3)->weekly()->create();

// Create completed chores
$completedChores = Chore::factory(5)->completed()->create();

// Create high priority chores
$urgentChores = Chore::factory(3)->highPriority()->create();
```

### 4. MealFactory

Generates meal data with nutritional information.

**Usage:**

```php
// Create breakfast
$breakfast = Meal::factory()->breakfast()->create();

// Create lunch
$lunch = Meal::factory()->lunch()->create();

// Create dinner
$dinner = Meal::factory()->dinner()->create();

// Create low-calorie meal
$lightMeal = Meal::factory()->lowCalorie()->create();

// Create high-protein meal
$proteinMeal = Meal::factory()->highProtein()->create();
```

### 5. FoodEntryFactory

Generates individual food items with nutritional data.

**Usage:**

```php
// Create high-protein food
$proteinFood = FoodEntry::factory()->highProtein()->create();

// Create low-carb food
$lowCarbFood = FoodEntry::factory()->lowCarb()->create();

// Create fruit
$fruit = FoodEntry::factory()->fruit()->create();

// Create vegetable
$vegetable = FoodEntry::factory()->vegetable()->create();
```

### 6. WeightLogFactory

Generates weight tracking data.

**Usage:**

```php
// Create adult weight log
$adultLog = WeightLog::factory()->adult()->create();

// Create child weight log
$childLog = WeightLog::factory()->child()->create();

// Create weight loss trend
$weightLoss = WeightLog::factory(10)->weightLoss()->create();

// Create recent logs
$recentLogs = WeightLog::factory(5)->recent()->create();
```

### 7. CalendarEventFactory

Generates calendar events with different types.

**Usage:**

```php
// Create personal event
$personalEvent = CalendarEvent::factory()->personal()->create();

// Create family event
$familyEvent = CalendarEvent::factory()->family()->create();

// Create work event
$workEvent = CalendarEvent::factory()->work()->create();

// Create all-day event
$allDayEvent = CalendarEvent::factory()->allDay()->create();

// Create urgent event
$urgentEvent = CalendarEvent::factory()->urgent()->create();
```

## Complex Examples

### Create a Complete Family with Data

```php
// Create family with members
$family = Family::factory()->create();
$parent = FamilyMember::factory()->parent()->create(['family_id' => $family->id]);
$child = FamilyMember::factory()->child()->create(['family_id' => $family->id]);

// Add chores
Chore::factory(5)->create(['family_id' => $family->id, 'assigned_to' => $parent->id]);

// Add meals
$meal = Meal::factory()->create(['family_id' => $family->id, 'family_member_id' => $parent->id]);
FoodEntry::factory(3)->create(['meal_id' => $meal->id]);

// Add weight logs
WeightLog::factory(5)->create(['family_member_id' => $parent->id]);

// Add calendar events
CalendarEvent::factory(3)->create(['family_id' => $family->id]);
```

### Run Comprehensive Seeding

```php
// Run the comprehensive seeder
php artisan db:seed --class=FamplanTestDataSeeder
```

## Factory States

Each factory includes various states for different scenarios:

- **FamilyFactory**: `inactive()`, `minimal()`
- **FamilyMemberFactory**: `parent()`, `child()`, `guardian()`, `inactive()`
- **ChoreFactory**: `daily()`, `weekly()`, `monthly()`, `completed()`, `highPriority()`
- **MealFactory**: `breakfast()`, `lunch()`, `dinner()`, `snack()`, `lowCalorie()`, `highProtein()`
- **FoodEntryFactory**: `highProtein()`, `lowCarb()`, `highFiber()`, `fruit()`, `vegetable()`
- **WeightLogFactory**: `adult()`, `child()`, `recent()`, `withBodyComposition()`, `weightLoss()`, `weightGain()`
- **CalendarEventFactory**: `personal()`, `family()`, `work()`, `health()`, `allDay()`, `recurring()`, `urgent()`

## Testing with Factories

```php
// In your tests
public function test_family_has_members()
{
    $family = Family::factory()->create();
    $members = FamilyMember::factory(3)->create(['family_id' => $family->id]);

    $this->assertCount(3, $family->members);
}

public function test_chore_can_be_completed()
{
    $chore = Chore::factory()->create();
    $chore->update(['status' => 'completed', 'completed_at' => now()]);

    $this->assertEquals('completed', $chore->status);
    $this->assertNotNull($chore->completed_at);
}
```
