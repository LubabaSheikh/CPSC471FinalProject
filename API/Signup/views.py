from django.shortcuts import render
from rest_framework.response import Response
from rest_framework import status
from rest_framework.views import APIView
from django.views.decorators.csrf import csrf_exempt #import this to allow other domains to access our api methods 

from rest_framework.parsers import JSONParser # allows us to parse the incoming data into our data model
from django.http.response import JsonResponse

from User.models import Person, Coordinator, Volunteer, Externalvolunteer, Potentialvolunteer
from User.serializers import PersonSerializer, VolunteerSerializer

from Signup.models import Shift, Seminar, Assign, Attends
from Signup.serializers import ShiftSerializer, ShiftDateSerializer, ShiftTimeSerializer, ShiftPlaceSerializer, SeminarSerializer, SeminarDateSerializer
from Signup.serializers import SeminarNameSerializer, SeminarTimeSerializer, SeminarCoordinatorSerializer, AssignSerializer, AttendsSerializer
from Signup.serializers import ReflectionSerializer

# Create your views here.


class ShiftVolunteerDetails(APIView):
    # Endpoint 9
        def get(self, request, pk, format=None):
            shift = Assign.objects.get(s = pk)
            serializer = AssignSerializer(shift)
            return Response (serializer.data)

class ShiftDate(APIView):
    # Endpoint 10
        def get(self, request, pk, format=None):
            shift = Shift.objects.get(pk = pk)
            serializer = ShiftDateSerializer(shift)
            return Response (serializer.data)



class ShiftTime(APIView):
    # Endpoint 11
        def get(self, request, pk, format=None):
            shift = Shift.objects.get(pk = pk)
            serializer = ShiftTimeSerializer(shift)
            return Response (serializer.data)


class ShiftPlace(APIView):
    # Endpoint 12
        def get(self, request, pk, format=None):
            shift = Shift.objects.get(pk = pk)
            serializer = ShiftPlaceSerializer(shift)
            return Response (serializer.data)

class CreateSeminar(APIView):
    # Endpoint 14
        def post(self, request, format=None):
            serializer = SeminarSerializer(data = request.data)
            if serializer.is_valid():
                serializer.save()
                return Response (serializer.data, status=status.HTTP_201_CREATED)
            return Response (serializer.errors, status=status.HTTP_400_BAD_REQUEST)

class SeminarName(APIView):
    # Endpoint 20
        def get(self, request, pk, format=None):
            shift = Seminar.objects.get(pk = pk)
            serializer = SeminarNameSerializer(shift)
            return Response (serializer.data)

    # Endpoint 15
        def put(self, request, id): # , format=None):
            seminar = Seminar.objects.get(seminar_id = id)
            serializer = SeminarSerializer(seminar, data=request.data)
            # print(shift)
            if serializer.is_valid():
                # print(request.data)
                serializer.save()
                return Response (serializer.data)
            return Response (serializer.errors, status=status.HTTP_400_BAD_REQUEST)

class SeminarDate(APIView):
    # Endpoint 21
        def get(self, request, pk, format=None):
            shift = Seminar.objects.get(pk = pk)
            serializer = SeminarDateSerializer(shift)
            return Response (serializer.data)

class SeminarTime(APIView):
    # Endpoint 21
        def get(self, request, pk, format=None):
            shift = Seminar.objects.get(pk = pk)
            serializer = SeminarTimeSerializer(shift)
            return Response (serializer.data)

    # Endpoint 16
        def put(self, request, id): # , format=None):
            seminar = Seminar.objects.get(seminar_id = id)
            serializer = SeminarSerializer(seminar, data=request.data)
            # print(shift)
            if serializer.is_valid():
                # print(request.data)
                serializer.save()
                return Response (serializer.data)
            return Response (serializer.errors, status=status.HTTP_400_BAD_REQUEST)

class SeminarCoordinator(APIView):
    # Endpoint 24
        def get(self, request, pk, format=None):
            shift = Seminar.objects.get(pk = pk)
            serializer = SeminarCoordinatorSerializer(shift)
            return Response (serializer.data)


class AttendsSeminar(APIView):
    # Endpoint 17
    def put(self, request, id):
            volunteersSeminar = Attends.objects.get(sem= id)
            serializer = AttendsSerializer(Attends, data=request.data)
            if serializer.is_valid():
                serializer.save()
                return Response (serializer.data)
            return Response (serializer.errors, status=status.HTTP_400_BAD_REQUEST) 
            
    
class AddReflection(APIView):
    # Endpoint 31
    def post(self, request, format=None):
        serializer = ReflectionSerializer (data=request.data)
        if serializer.is_valid ( ):
            serializer.save ( )
            return Response (serializer.data, status=status.HTTP_201_CREATED)
        return Response (serializer.errors, status=status.HTTP_400_BAD_REQUEST)
