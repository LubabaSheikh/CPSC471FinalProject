# from django.conf.urls import urls
from django.urls import path,include
from django.urls import re_path
from User import views



urlpatterns = [
    path('all-volunteers/', views.internalVolunteer.as_view()), # New Endpoint
    path('search-volunteer/<int:pk>', views.internalVolunteerDetails.as_view()), # Endpoint 5
    
    path('create-user/', views.internalVolunteer.as_view()), # Endpoint 1
    # path('getvolunteershiftids/<int:pk>', views.internalVolunteerGetShiftID.as_view()),

    re_path(r'^update-person-details/(?P<id>\d+)/$', views.PersonDetails.as_view(), ), # Endpoint 28

    re_path(r'^delete-person/(?P<id>\d+)/$', views.PersonDelete.as_view(), ), # Endpoint 41

    re_path(r'^update-volunteer/(?P<v>\d+)/$', views.internalVolunteerDetails.as_view(), ), # Endpoint 40

]