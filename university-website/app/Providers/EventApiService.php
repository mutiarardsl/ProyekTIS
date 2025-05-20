<?php
namespace App\Providers;

use Illuminate\Support\Facades\Http;

class EventApiService{
protected $baseUrl;

public function __construct()
{
$this->baseUrl = env('EVENT_API_URL', 'http://localhost:8000/api');
}

public function getAllEvents()
{
$response = Http::get("{$this->baseUrl}/events");
return $response->json()['data'];
}

public function getUniversityEvents()
{
$response = Http::get("{$this->baseUrl}/events", [
'organizer' => 'university'
]);
return $response->json()['data'];
}

public function createEvent($eventData)
{
$eventData['organizer'] = 'university';
$eventData['organizer_id'] = 1; // ID universitas

$response = Http::post("{$this->baseUrl}/events", $eventData);
return $response->json();
}

public function updateEvent($id, $eventData)
{
$response = Http::put("{$this->baseUrl}/events/{$id}", $eventData);
return $response->json();
}

public function deleteEvent($id)
{
$response = Http::delete("{$this->baseUrl}/events/{$id}");
return $response->json();
}

public function getEventDetails($id)
{
$response = Http::get("{$this->baseUrl}/events/{$id}");
return $response->json()['data'];
}
}