<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>User Profile</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  @include('partials.style_head')

  <style>
      .logout-link {
          text-decoration: none;
          color: inherit;
      }

      .logout-link:hover {
          color: inherit;
      }
  </style>
</head>

<body class="bg-light">

  <div class="header d-flex justify-content-between align-items-center p-3 bg-white shadow-sm mb-4 position-relative">
    <div class="logo d-flex align-items-center">
        <span class="fs-4 me-2">&#119070;</span>
        <span class="fs-4">Clefinspire</span>
    </div>
    <div class="fs-5 position-absolute start-50 translate-middle-x">User Profile</div>
    <div style="width: 100px;"></div>
  </div>

  <div class="profile-section text-center">
    <div class="d-flex justify-content-center align-items-center mb-3 position-relative">
        @if($badges->count() > 0)
        <div class="position-absolute d-flex flex-column align-items-center" style="left: calc(50% - 230px); transform: translateX(-50%);">
            <div class="rounded-circle bg-secondary mb-2 d-flex align-items-center justify-content-center" 
                 style="width: 70px; height: 70px;" title="{{ $badges[0]->badge_desc }}">
                <i class="bi bi-award-fill text-white"></i>
            </div>
            <span class="text-muted small">{{ $badges[0]->badge_name }}</span>
        </div>
        @endif

        <div class="avatar">
            @if($user->profile_picture ?? false)
                <img src="{{ $user->profile_picture }}" alt="Profile Picture" 
                     class="rounded-circle border border-3 border-dark" style="width: 150px; height: 150px; object-fit: cover;">
            @else
                <div class="rounded-circle bg-pal-red d-flex align-items-center justify-content-center border border-3 border-dark" 
                     style="width: 150px; height: 150px; font-size: 3rem;">
                    {{ substr($user->display_name ?? $originalUser->name, 0, 1) }}
                </div>
            @endif
        </div>

        @if($badges->count() > 1)
        <div class="position-absolute d-flex flex-column align-items-center" style="right: calc(50% - 230px); transform: translateX(50%);">
            <div class="rounded-circle bg-secondary mb-2 d-flex align-items-center justify-content-center" 
                 style="width: 70px; height: 70px;" title="{{ $badges[1]->badge_desc }}">
                <i class="bi bi-award-fill text-white"></i>
            </div>
            <span class="text-muted small">{{ $badges[1]->badge_name }}</span>
        </div>
        @endif
    </div>
    
    <h2 class="mb-1">{{ $user->display_name ?? $originalUser->name }}</h2>
    
    @if($user->bio ?? false)
        <p class="text-muted mb-2">{{ $user->bio }}</p>
    @endif
  </div>

  <hr class="mt-0 mb-4">

  <div class="menu mx-auto" style="max-width: 500px;">
    <a href="#" class="text-decoration-none text-dark">
        <div class="d-flex justify-content-between align-items-center p-3 border border-1 border-danger rounded mb-4 hover-bg-light">
            <span>Personal Information</span>
            <i class="bi bi-chevron-right text-danger"></i>
        </div>
    </a>
    
    <a href="#" class="text-decoration-none text-dark">
        <div class="d-flex justify-content-between align-items-center p-3 border border-1 border-danger rounded mb-4 hover-bg-light">
            <span>Customize</span>
            <i class="bi bi-chevron-right text-danger"></i>
        </div>
    </a>
    
    <a href="javascript:void(0);" onclick="confirmLogout()" class="logout-link">
        <div class="d-flex justify-content-between align-items-center p-3 border border-1 border-danger rounded mb-4 hover-bg-light">
            <span>Logout</span>
            <i class="bi bi-chevron-right text-danger"></i>
        </div>
    </a>
  </div>

  <form id="logoutForm" action="{{ route('logout') }}" method="POST" class="mb-0">
     @csrf
      <button type="submit" id="logoutSubmit"></button>
  </form>

  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>

  <script>
      function confirmLogout() {
          if (confirm("Do you want to log out?")) {
              document.getElementById("logoutForm").submit();
          }
      }
  </script>

</body>
</html>
