from django import urls
from django.urls import re_path
from django.urls import path,include
from Addons import views



urlpatterns = [
    
    # path('update-covid-status/<int:pid>', views.CovidStatus.as_view()), # Endpoint 34
    
    # re_path(r'^update-seminar-name/(?P<id>\d+)/$', views.SeminarName.as_view(), ), # Endpoint 15
    re_path(r'^update-covid-status/(?P<id>\d+)/$', views.CovidStatusDetails.as_view(), ), # Endpoint 34
    re_path(r'^update-reward/(?P<id>\d+)/$', views.RewardsDetails.as_view(), ), # Endpoint 6

]