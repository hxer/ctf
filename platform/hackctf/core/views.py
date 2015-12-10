from django.shortcuts import render

# Create your views here.
def home(request):
    if request.user.is_authenticated():
        return render(request, 'core/index.html')
    else:
        return render(request, 'core/cover.html')
