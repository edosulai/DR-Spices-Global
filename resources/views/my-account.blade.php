<x-guest-layout>

  <div class="user-acount">

    @livewire('header')

    <div class="main-content">
      <div class="wrap-banner">

        <x-breadcrumb :navs="[
          ['title' => 'Home', 'url' => route('home')],
          ['title' => 'My Account', 'url' => route('account')],
        ]" />

        <div class="acount head-acount">
          <div class="container">
            <div class="main">
              <h1 class="title-page">My Account</h1>
              <div class="content" id="block-history">
                <table class="std table">
                  <tbody>
                    <tr>
                      <th class="first_item">My Name :</th>
                      <td>David James</td>
                    </tr>
                    <tr>
                      <th class="first_item">Company :</th>
                      <td>TivaTheme</td>
                    </tr>
                    <tr>
                      <th class="first_item">Address :</th>
                      <td>123 canberra Street, New York, USA</td>
                    </tr>
                    <tr>
                      <th class="first_item">City :</th>
                      <td>New York</td>
                    </tr>
                    <tr>
                      <th class="first_item">Postal/Zip Code :</th>
                      <td>10001</td>
                    </tr>
                    <tr>
                      <th class="first_item">Phone :</th>
                      <td>0123456789</td>
                    </tr>
                    <tr>
                      <th class="first_item">Country:</th>
                      <td>USA</td>
                    </tr>
                  </tbody>
                </table>

              </div>
              <button class="btn btn-primary" data-link-action="sign-in" type="submit">
                view Address
              </button>
              <div class="order">
                <h4>Order
                  <span class="detail">History</span>
                </h4>
                <p>You haven't placed any orders yet.</p>
              </div>
            </div>

          </div>
        </div>
      </div>
    </div>

    <x-footer />

    <x-pre-loader />

    <x-back-top />

  </div>

</x-guest-layout>