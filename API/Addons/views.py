from django.shortcuts import render
from rest_framework.response import Response
from rest_framework import status
from rest_framework.views import APIView
from django.views.decorators.csrf import csrf_exempt #import this to allow other domains to access our api methods 

from rest_framework.parsers import JSONParser # allows us to parse the incoming data into our data model
from django.http.response import JsonResponse

from Addons.models import Covidstatus, Equipment, Rewards, Parking
from Addons.serializers import CovidstatusSerializer, EquipmentSerializer, RewardsSerializer, ParkingSerializer

# Create your views here.


class CovidStatusDetails(APIView):
    
    # Endpoint 34
        def put(self, request, id): # , format=None):
            info = Covidstatus.objects.get(person = id)
            print("HELLOOOO")
            print(info)
            serializer = CovidstatusSerializer(info, data=request.data)
            # print(shift)
            if serializer.is_valid():
                # print(request.data)
                serializer.save()
                return Response (serializer.data)
            return Response (serializer.errors, status=status.HTTP_400_BAD_REQUEST)


class RewardsDetails(APIView):
    # Endpoint 6
    def put(self, request, id):
            x = Rewards.objects.get(reward_id = id)
            serializer = RewardsSerializer(x, data=request.data)
            if serializer.is_valid():
                serializer.save()
                return Response (serializer.data)
            return Response (serializer.errors, status=status.HTTP_400_BAD_REQUEST)
