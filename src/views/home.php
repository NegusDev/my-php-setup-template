<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alpine.js with PHP Example</title>
    <!-- Include Alpine.js library -->
    <script defer src="https://cdn.jsdelivr.net/npm/@imacrayon/alpine-ajax@0.3.0/dist/cdn.min.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.11.1/dist/cdn.min.js"></script>
</head>

<body>
    <div x-data="{
        items: {},
        async pageData() {
            try {
                const response = await fetch('/');
                this.items = await response.json();
                // Log out all the posts to the console
                console.log(this.items.datas);
                console.log(this.items.title);

                this.items.datas.forEach((data) => {
                    console.log(data);
                });
                
            } catch (error) {
                console.error('Error fetching data:', error);
            }
        }
            }" x-init="pageData">
    </div>
    <h1 x-text="items.title"></h1>
    <ul>
        <template x-for="item in items.data" >
            <li>
                <span x-text="item"></span>
            </li>
        </template>
    </ul>

    <div x-show="items.length === 0">
        <p>No items left.</p>
    </div>
</body>

</html>