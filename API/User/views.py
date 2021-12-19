from django.shortcuts import render
import Signup
from django.db.models import F
from rest_framework import status
from rest_framework.response import Response
from rest_framework.views import APIView
from django.views.decorators.csrf import csrf_exempt #import this to allow other domains to access our api methods 

from rest_framework.parsers import JSONParser # allows us to parse the incoming data into our data model
from django.http.response import JsonResponse

from User.models import Person, Coordinator, Volunteer, Externalvolunteer, Potentialvolunteer
from User.serializers import PersonSerializer, VolunteerSerializer

from Signup.models import Shift, Seminar, Assign, Attends
from Signup.serializers import ShiftSerializer,  SeminarSerializer, AssignSerializer, AttendsSerializer

# Create your views here.



class PersonDetails(APIView):

    # Endpoint 28
    def put(self, request, id): #, format=None):
        user = Person.objects.get(sin = id)
        serializer = PersonSerializer(user, data=request.data)
        if serializer.is_valid():
            serializer.save()
            return Response (serializer.data)
        return Response (serializer.errors, status=status.HTTP_400_BAD_REQUEST)


class PersonDelete(APIView):
    # Endpoint 41
    def delete(self, request, id, format=None):
        user = Person.objects.filter(sin=id)
        user.delete()
        return Response(status=status.HTTP_204_NO_CONTENT)





class internalVolunteerDetails (APIView): # create a new internal volunteer 
    
    # def post(self, request, format=None):
    #     serializer = UserSerializer (data=request.data)
    #     if serializer.is_valid ( ):
    #         serializer.save ( )
    #         return Response (serializer.data, status=status.HTTP_201_CREATED)
    #     return Response (serializer.errors, status=status.HTTP_400_BAD_REQUEST)

    # Endpoint 5
    def get(self, request, pk, format=None):
        user = Volunteer.objects.get (pk=pk)
        serializer = VolunteerSerializer(user)
        return Response (serializer.data)

    def put(self, request, v): #, format=None):
        user = Volunteer.objects.get(v = v)
        serializer = VolunteerSerializer(user, data=request.data)
        if serializer.is_valid():
            serializer.save()
            return Response (serializer.data)
        return Response (serializer.errors, status=status.HTTP_400_BAD_REQUEST)


class internalVolunteer (APIView): # create a new internal volunteer 

    # Endpoint 1
    def post(self, request, format=None):
        serializer = PersonSerializer(data = request.data)
        if serializer.is_valid():
            serializer.save()
            return Response (serializer.data, status=status.HTTP_201_CREATED)
        return Response (serializer.errors, status=status.HTTP_400_BAD_REQUEST)

    
    def get(self, request, format=None):
        user = Volunteer.objects.all()
        serializer = VolunteerSerializer(user, many=True)
        return Response (serializer.data)

    # def put(self, request, pk, format=None):
    #     user = User.objects.filter(pk=pk).first()
    #     serializer = UserSerializer(user, data=request.data)
    #     print(user)
    #     if serializer.is_valid ( ):
    #         print(request.data)
    #         serializer.save()
    #         return Response (serializer.data)
    #     return Response (serializer.errors, status=status.HTTP_400_BAD_REQUEST)



# class internalVolunteerGetShiftID (APIView):
    
#     # Endpoint 8
#     def get(self, request, pk, format=None):

#         y = P.object.get(pk = pk)
#         # x = Assign.objects.raw('SELECT s_id, volunteer_id FROM assign WHERE volunteer_id = y.SIN')

#         x = 0
#         for e in Assign.objects.all():
#             if (y.sin == e.volunteer):
#                 x += Assign.objects.get(e.s_id)

        
#         # print(shiftids)
#         serializer = Assign.Serializer(x)
#         return Response (serializer.data)


# class externalVolunteer (APIView): # create a new external volunteer 
#     def post(self, request, format=None):
#         serializer = UserSerializer (data=request.data)
#         if serializer.is_valid ( ):
#             serializer.save ( )
#             return Response (serializer.data, status=status.HTTP_201_CREATED)
#         return Response (serializer.errors, status=status.HTTP_400_BAD_REQUEST)
    
    # def get(self, request, pk, format=None):
    #     user = User.objects.get (pk=pk)
    #     serializer = UserSerializer(user)
    #     return Response (serializer.data)
    
    # def put(self, request, pk, format=None):
    #     user = User.objects.filter(pk=pk).first()
    #     serializer = UserSerializer(user, data=request.data)
    #     print(user)
    #     if serializer.is_valid ( ):
    #         print(request.data)
    #         serializer.save()
    #         return Response (serializer.data)
    #     return Response (serializer.errors, status=status.HTTP_400_BAD_REQUEST)

# class newCoordinator (APIView): # create a new coordinator
#     def post(self, request, format=None):
#         serializer = UserSerializer (data=request.data)
#         if serializer.is_valid ( ):
#             serializer.save ( )
#             return Response (serializer.data, status=status.HTTP_201_CREATED)
#         return Response (serializer.errors, status=status.HTTP_400_BAD_REQUEST)

# class potentialVolunteer (APIView): # create a new potential volunteer
#     def post(self, request, format=None):
#         serializer = UserSerializer (data=request.data)
#         if serializer.is_valid ( ):
#             serializer.save ( )
#             return Response (serializer.data, status=status.HTTP_201_CREATED)
#         return Response (serializer.errors, status=status.HTTP_400_BAD_REQUEST)
    
#     def get(self, request, pk, format=None):
#         user = User.objects.get (pk=pk)
#         serializer = UserSerializer(user)
#         return Response (serializer.data)
    
#     def put(self, request, pk, format=None):
#         user = User.objects.filter(pk=pk).first()
#         serializer = UserSerializer(user, data=request.data)
#         print(user)
#         if serializer.is_valid ( ):
#             print(request.data)
#             serializer.save()
#             return Response (serializer.data)
#         return Response (serializer.errors, status=status.HTTP_400_BAD_REQUEST)
