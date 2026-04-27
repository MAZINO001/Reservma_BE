<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use App\Services\NotificationService;
use App\Http\Requests\StoreNotificationRequest;
use App\Http\Requests\UpdateNotificationRequest;
use Illuminate\Http\JsonResponse;

class NotificationController extends Controller
{
    public function __construct(
        protected NotificationService $notificationService
    ) {}

    public function index(): JsonResponse
    {
        $notifications = $this->notificationService->getAll();
        return response()->json($notifications);
    }

    public function store(StoreNotificationRequest $request): JsonResponse
    {
        $notification = $this->notificationService->create($request->validated());
        return response()->json($notification, 201);
    }

    public function show(Notification $notification): JsonResponse
    {
        return response()->json($this->notificationService->find($notification));
    }

    public function update(UpdateNotificationRequest $request, Notification $notification): JsonResponse
    {
        $notification = $this->notificationService->update($notification, $request->validated());
        return response()->json($notification);
    }

    public function destroy(Notification $notification): JsonResponse
    {
        $this->notificationService->delete($notification);
        return response()->json(['message' => 'Notification deleted successfully']);
    }
}