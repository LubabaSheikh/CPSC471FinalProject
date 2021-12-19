from django import urls
from django.urls import re_path
from django.urls import path,include
from Signup import views



urlpatterns = [
    path('shift/<int:pk>', views.ShiftVolunteerDetails.as_view()), # Endpoint 9
    path('get-shift-date/<int:pk>', views.ShiftDate.as_view()), # Endpoint 10
    path('get-shift-time/<int:pk>', views.ShiftTime.as_view()), # Endpoint 11
    path('get-shift-place/<int:pk>', views.ShiftPlace.as_view()), # Endpoint 12

    path('create-seminar/', views.CreateSeminar.as_view()), # Endpoint 14

    re_path(r'^update-seminar/(?P<id>\d+)/$', views.SeminarName.as_view(), ), # Endpoint 15
    re_path(r'^update-seminar-time/(?P<id>\d+)/$', views.SeminarTime.as_view(), ), # Endpoint 16
    re_path(r'^update-volunteer-registered-for-seminar/(?P<id>\d+)/$', views.AttendsSeminar.as_view(), ), # Endpoint 17

    path('get-seminar-name/<int:pk>', views.SeminarName.as_view()), # Endpoint 20
    path('get-seminar-date/<int:pk>', views.SeminarDate.as_view()), # Endpoint 21
    path('get-seminar-time/<int:pk>', views.SeminarTime.as_view()), # Endpoint 22
    path('get-seminar-coordinator/<int:pk>', views.SeminarCoordinator.as_view()), # Endpoint 24

    path('add-reflection/', views.AddReflection.as_view()), # Endpoint 31
]
