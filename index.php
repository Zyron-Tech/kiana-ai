<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AI Songwriter</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="styles.css">
</head>
<body>
  <!-- Nav bar section -->
    <header>
        <nav class="navbar navbar-expand-lg bg-body-tertiary">
            <div class="container-fluid" style="display: flex; flex-direction: row;">
              <a class="navbar-brand" href="/">Kiana<span class="ai">AI</span></a>
              <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
              </button>
              <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                  <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="#">Home</a>
                  </li>
                  <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                      Socials
                    </a>
                    <ul class="dropdown-menu">
                      <li><a class="dropdown-item" href="https://www.linkedin.com/in/mathew-peace/"><i class="fa-brands fa-linkedin"></i> LinkedIn </a></li>
                      <li><a class="dropdown-item" href="https://www.facebook.com/profile.php?id=100087072219966"><i class="fa-brands fa-facebook"></i> FaceBook</a></li>
                      <li><a class="dropdown-item" href="https://api.whatsapp.com/send/?phone=2349032043408&text&type=phone_number&app_absent=0"><i class="fa-brands fa-whatsapp"></i> Whatsapp</a></li>
                      <li><a class="dropdown-item" href="https://x.com/entheos_11"><i class="fa-brands fa-x-twitter"></i> Twitter</a></li>
                    </ul>
                  </li>
                </ul>
                <a href="https://github.com/Zyron-Tech/kiana-ai"><i class="fa-brands fa-github" style="font-size: 30px;color: #0056b3;"><span style="font-size: 17px; font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif; color: #0056b3;"> <b>Source Code</b></span></i></a>
              </div>
            </div>
          </nav>
    </header>
    <!--Hero-->
    <div class="card text-center">
      <div class="card-body">
        <h3 class="card-title"><span style="font-family: 'Courier New', Courier, monospace; font-weight: bold;">Kiana<span style="background-color: #ffffff; color: #011983; padding: 0.3%; border-radius: 15%; margin-left: 5px;">AI</span></span></h3>
        <p class="card-text">Create music with Kiana AI free of charge | No login required | No sign up required |<span style="color:red; font-weight:bold;"> 100% FREE</span>.</p>
        <a href="#aisong" class="btn btn-primary">Start Creating</a>
      </div>
    </div>
    <!--AI song writer-->
    <div class="container" id="aisong">
        <h1>AI Songwriter</h1>
        <form id="songForm">
            <label for="musicStyle">Select Music Style:</label>
            <select id="musicStyle" required>
                <option value="">Choose a style...</option>
                <option value="Pop">Pop</option>
                <option value="Rock">Rock</option>
                <option value="Hip-Hop">Hip-Hop</option>
                <option value="Classical">Classical</option>
                <option value="Gospel">Gospel</option>
            </select>
            <label for="country">Select Country:</label>
            <select id="country" required>
                <option value="">Choose a country...</option>
                <option value="USA">USA</option>
                <option value="Nigeria">Nigeria</option>
                <option value="India">India</option>
                <option value="UK">UK</option>
            </select>

            <label for="prompt">Describe Your Song:</label>
            <textarea id="prompt" placeholder="e.g., A love song about heartbreak in the rain" required></textarea>

            <button type="submit">Generate Song</button>
        </form>

        <div class="output" id="output"></div>
    </div>
    <!-- FAQ section -->
    <div class="accordion accordion-flush" id="accordionFlushExample">
      <P class="faq" align="center"><u>FAQ'<span>s</span></u></P>
      <div class="accordion-item">
        <h2 class="accordion-header">
          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
            What is the cost to create a song with Kiana AI
          </button>
        </h2>
        <div id="flush-collapseOne" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
          <div class="accordion-body">Kiana AI is 100% free to use, it requires no payment, login or registration to use all our basic services</div>
        </div>
      </div>
      <div class="accordion-item">
        <h2 class="accordion-header">
          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
            Can Kiana AI also generate the musical notation for my generated song
          </button>
        </h2>
        <div id="flush-collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
          <div class="accordion-body">Kiana AI generates proper sulfa musical notations along side with the lyrics generated</div>
        </div>
      </div>
      <div class="accordion-item">
        <h2 class="accordion-header">
          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">
            How to use
          </button>
        </h2>
        <div id="flush-collapseThree" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
          <div class="accordion-body">To use Kiana AI efficiently, select your music style first, then select the country(this will help the AI to fine tune it to your country's taste). Finally, enter your prompt describing your music, and then sit back and relax, while Kiana AI does the work for you.</div>
        </div>
      </div>
    </div>

    <!-- footer -->
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
      <div class="container-fluid" style="display: flex; flex-direction: column;">
        <a class="navbar-brand" style="font-size: 150%;" href="/">Kiana<span class="ai">AI</span></a>
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          </ul>
          <div style="display: flex;">
          <a class="nav-link active" style="margin-right: 0%; font-weight: bold;" aria-current="page" href="https://peacemathew.com.ng">&copy 2025 Zyron Tech</a>
          </div>
          <div style="display: flex; flex-direction: row;">
            <a class="dropdown-item" style="margin-right: 30%;" href="https://www.linkedin.com/in/mathew-peace/"><i class="fa-brands fa-linkedin"></i> </a>
            <a class="dropdown-item" style="margin-right: 30%;" href="https://www.facebook.com/profile.php?id=100087072219966"><i class="fa-brands fa-facebook"></i> </a>
            <a class="dropdown-item" style="margin-right: 30%;" href="https://api.whatsapp.com/send/?phone=2349032043408&text&type=phone_number&app_absent=0"><i class="fa-brands fa-whatsapp"></i> </a>
            <a class="dropdown-item" style="margin-right: 30%;" href="https://x.com/entheos_11"><i class="fa-brands fa-x-twitter"></i> </a> 
        
        </div>
      </div>
    </nav>


    <script>
        const form = document.getElementById('songForm');
        const output = document.getElementById('output');

        form.addEventListener('submit', async (e) => {
            e.preventDefault();

            const musicStyle = document.getElementById('musicStyle').value;
            const country = document.getElementById('country').value;
            const prompt = document.getElementById('prompt').value;

            output.innerText = 'Generating your song...';

            try {
                const response = await fetch('backend.php', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({ musicStyle, country, prompt })
                });

                const data = await response.json();
                if (data.song) {
                    output.innerText = data.song;
                } else {
                    output.innerText = data.song';
                }
            } catch (error) {
                output.innerText = 'Error: Unable to generate a song.';
            }
        });
        
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
