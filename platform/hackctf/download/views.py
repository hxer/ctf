from __future__ import unicode_literals

from django.shortcuts import render
from django.http import StreamingHttpResponse   #文件流发送给服务器

# Create your views here.
def file_download(request):
    #do something

    def file_iterator(file_name, chunk_size=512):
        with open(file_name) as f:
            while True:
                content = f.read(chunk_size)
                if content:
                    yield content
                else:
                    break

    file_name = "test_download.txt"
    response = StreamingHttpResponse(file_iterator(file_name))
    #使文件流下载到硬盘
    response['Content-Type'] = 'application/octet-stream'
    response['Content-Dispostion'] = 'attachment;filename="{0}"'.format(file_name)

    return response
