<h1>
    GET api/posts
</h1>

<h2>
Resource URL
</h2>
<p>http://myapi.com/app_dev.php/api/posts</p>
<h2>
Resource Information
</h2>
<table>
<tr>
    <td>Response formats</td>
    <td>JSON</td>
</tr>
<tr>
    <td>Requires authentication?</td>
    <td>YES</td>
</tr>
</table>
<h2>
Parameters
</h2>
<table>
<tr>
    <td>start</td>
    <td>start page, default 1</td>
</tr>
<tr>
    <td>limit</td>
    <td>limit count page, default 10</td>
</tr>
</table>
<h2>
Example Request
</h2>
<p>
GET
http://myapi.com/app_dev.php/api/posts?start=2$limit=5
</p>
<h2>
Format output data
</h2>
<pre>
{
    "posts": [
        {
            "titlePost": " ",
            "textPost": " ",
            "slug": " ",
            "createdAt": {
                "date": " ",
                "timezone_type": " ",
                "timezone": " "
            },
            "author": {
                "id": " ",
                "email": " ",
                "firstName": " ",
                "lastName": " "
            }
    ]
}
</pre>