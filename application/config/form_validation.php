<?php
$config=array(
	"register"=>array(
		array(
            'field' => 'username',
            'label' => 'Korisničko ime',
			'rules' => 'trim|required|alpha_dash|min_length[6]|max_length[18]|is_unique[users.username]',
			'errors' => array(
				'min_length' => "Nedovoljna dužina. Minimalna dužina je 6.",
				'max_length' => "Prevelika dužina. Maksimalna dužina je 18.",
				'is_unique' => "Ovo {field} je već zauzeto.",
				'required' => "Ovo polje je obavezno.",
				'alpha_numeric' => "Dozvoljeni su samo alfa-numerički znakovi."
			)

        ),
        array(
            'field' => 'email',
            'label' => 'eMail',
			'rules' => 'trim|required|valid_email|is_unique[users.email]',
			'errors' => array(
				'is_unique' => "Ovaj {label} je već zauzet.",
				'required' => "Ovo polje je obavezno.",
				'valid_email' => "Ovaj {label} nije validan."
			)

        ),
        array(
            'field' => 'password',
            'label' => 'Lozinka',
			'rules' => 'trim|required|min_length[8]|max_length[20]|alpha_numeric',
			'errors' => array(
				'min_length' => "Nedovoljna dužina. Minimalna dužina je 8.",
				'max_length' => "Prevelika dužina. Maksimalna dužina je 20.",
				'required' => "Ovo polje je obavezno.",
				'alpha_numeric' => "Dozvoljeni su samo alfa-numerički znakovi."
			)

        ),
        array(
            'field' => 'conf_password',
            'label' => 'Potvrđena lozinka',
			'rules' => 'trim|required|matches[password]',
			'errors' => array(
				'required' => "Ovo polje je obavezno.",
				'matches' => "Razlikuje se od Lozinke."
			)

        ),

	),
	'login'=>array(
		array(
            'field' => 'username',
            'label' => 'Korisnicko ime',
			'rules' => 'trim|required',
			'errors' => array(
				'required' => "Ovo polje je obavezno."
			)

        ),
        array(
            'field' => 'password',
            'label' => 'Lozinka',
			'rules' => 'trim|required|callback_log_user',
			'errors' => array(
				'required' => "Ovo polje je obavezno."
			)

        )
	),
	'complete_regist_client' =>array(
		array(
            'field' => 'firstname',
            'label' => 'Ime',
			'rules' => 'trim|required|alpha',
			'errors' => array(
				'required' => "Ovo polje je obavezno.",
				'alpha' => "Dozvoljena su samo slova."
			)

        ),
        array(
            'field' => 'lastname',
            'label' => 'Prezime',
			'rules' => 'trim|required|alpha_dash',
			'errors' => array(
				'required' => "Ovo polje je obavezno.",
				'alpha_dash' => "Dozvoljena su samo slova."
			)

        ),
        array(
            'field' => 'phone',
            'label' => 'Telefon',
			'rules' => 'trim|numeric',
			'errors' => array(
				'required' => "Ovo polje je obavezno.",
				'numeric' => "Dozvoljeni su samo brojevi"
			)

        ),
        array(
            'field' => 'gender',
            'label' => 'Pol',
			'rules' => 'trim|numeric',
			'errors' => array(
				'required' => "Ovo polje je obavezno.",
				'numeric' => "Dozvoljeni su samo brojevi"
			)

        ),
        array(
            'field' => 'city',
            'label' => 'Grad',
			'rules' => 'trim|numeric',
			'errors' => array(
				'required' => "Ovo polje je obavezno.",
				'numeric' => "Dozvoljeni su samo brojevi"
			)

        )
	),
	'complete_regist_company' =>array(
		array(
            'field' => 'name',
            'label' => 'Ime',
			'rules' => 'trim|required|alpha_numeric_spaces',
			'errors' => array(
				'required' => "Ovo polje je obavezno.",
				'alpha_numeric_spaces' => "Dozvoljena su samo slova i numerički znakovi."
			)

        ),
        array(
            'field' => 'address',
            'label' => 'Adresa',
			'rules' => 'trim|required',
			'errors' => array(
				'required' => "Ovo polje je obavezno."
			)

        ),
        array(
            'field' => 'phone1',
            'label' => 'Telefon',
			'rules' => 'trim|numeric',
			'errors' => array(
				'numeric' => "Dozvoljeni su samo brojevi"
			)

        ),
        array(
            'field' => 'phone2',
            'label' => 'Telefon',
			'rules' => 'trim|numeric',
			'errors' => array(
				'numeric' => "Dozvoljeni su samo brojevi"
			)

        ),
        array(
            'field' => 'type',
            'label' => 'Tip objekta',
			'rules' => 'trim|numeric',
			'errors' => array(
				'required' => "Ovo polje je obavezno.",
				'numeric' => "Dozvoljeni su samo brojevi"
			)

        ),
        array(
            'field' => 'city',
            'label' => 'Grad',
			'rules' => 'trim|numeric',
			'errors' => array(
				'required' => "Ovo polje je obavezno.",
				'numeric' => "Dozvoljeni su samo brojevi"
			)

        ),
        array(
            'field' => 'latitude',
            'label' => 'Latitude',
			'rules' => 'trim|numeric',
			'errors' => array(
				'required' => "Ovo polje je obavezno.",
				'numeric' => "Dozvoljeni su samo brojevi"
			)

        ),
        array(
            'field' => 'longitude',
            'label' => 'Longitude',
			'rules' => 'trim|numeric',
			'errors' => array(
				'required' => "Ovo polje je obavezno.",
				'numeric' => "Dozvoljeni su samo brojevi"
			)

        ),
        array(
            'field' => 'website',
            'label' => 'Website',
			'rules' => 'trim|valid_url',
			'errors' => array(
				'valid_url' => "Adresa nije ispravno unesena."
			)

        )
	),
	'search_objects'=>array(
		array(
            'field' => 'keywords',
            'label' => 'Kljucne reci',
			'rules' => '',
			'errors' => array(
			)

        ),
        array(
            'field' => 'city',
            'label' => 'Grad',
			'rules' => 'numeric',
			'errors' => array(
				'number' => "Ovo polje mora biti broj."
			)
        ),
        array(
            'field' => 'type',
            'label' => 'Tip',
			'rules' => 'numeric',
			'errors' => array(
				'number' => "Ovo polje mora biti broj."
			)
        ),
        array(
            'field' => 'distance',
            'label' => 'Rastojanje',
			'rules' => 'numeric',
			'errors' => array(
				'number' => "Ovo polje mora biti broj."
			)
        )
	),
	'add_comment'=>array(
		array(
            'field' => 'rating',
            'label' => 'Rejting',
			'rules' => 'numeric',
			'errors' => array(
			)

        )
	),
	'forgot_password'=>array(
		array(
            'field' => 'username',
            'label' => 'Korisnicko ime',
			'rules' => 'trim|required',
			'errors' => array(
				'required' => "Ovo polje je obavezno."
			)

        ),
        array(
            'field' => 'email',
            'label' => 'eMail',
			'rules' => 'trim|required|valid_email',
			'errors' => array(
				'required' => "Ovo polje je obavezno.",
				'valid_email' => "Ovaj {label} nije validan."
			)

        )

	),
	'change_password'=>array(
		array(
            'field' => 'password',
            'label' => 'Lozinka',
			'rules' => 'trim|required|min_length[8]|max_length[20]|alpha_numeric',
			'errors' => array(
				'min_length' => "Nedovoljna dužina. Minimalna dužina je 8.",
				'max_length' => "Prevelika dužina. Maksimalna dužina je 20.",
				'required' => "Ovo polje je obavezno.",
				'alpha_numeric' => "Dozvoljeni su samo alfa-numerički znakovi."
			)

        ),
        array(
            'field' => 'conf_password',
            'label' => 'Potvrđena lozinka',
			'rules' => 'trim|required|matches[password]',
			'errors' => array(
				'required' => "Ovo polje je obavezno.",
				'matches' => "Razlikuje se od Lozinke."
			)

        )
	),
	'client_change_settings' => array(
		array(
            'field' => 'firstname',
            'label' => 'Ime',
			'rules' => 'trim|alpha',
			'errors' => array(
				'alpha' => "Dozvoljena su samo slova."
			)

        ),
        array(
            'field' => 'lastname',
            'label' => 'Prezime',
			'rules' => 'trim',
			'errors' => array(
				'alpha' => "Dozvoljena su samo slova."
			)

        ),
        array(
            'field' => 'phone',
            'label' => 'Telefon',
			'rules' => 'trim|numeric',
			'errors' => array(
				'numeric' => "Dozvoljeni su samo brojevi"
			)

        ),
        array(
            'field' => 'gender',
            'label' => 'Pol',
			'rules' => 'trim|numeric',
			'errors' => array(
				'numeric' => "Dozvoljeni su samo brojevi"
			)

        ),
        array(
            'field' => 'city',
            'label' => 'Grad',
			'rules' => 'trim|numeric',
			'errors' => array(
				'numeric' => "Dozvoljeni su samo brojevi"
			)

        )
    ),
    'password_change' => array(
    	array(
            'field' => 'password',
            'label' => 'Lozinka',
			'rules' => 'trim|required',
			'errors' => array(
				'required' => "Ovo polje je obavezno.",
				'matches' => "Razlikuje se od Lozinke."
			)

        ),
		array(
            'field' => 'new_password',
            'label' => 'Nova Lozinka',
			'rules' => 'trim|required|min_length[8]|max_length[20]|differs[password]|alpha_numeric',
			'errors' => array(
				'min_length' => "Nedovoljna dužina. Minimalna dužina je 8.",
				'max_length' => "Prevelika dužina. Maksimalna dužina je 20.",
				'required' => "Ovo polje je obavezno.",
				'alpha_numeric' => "Dozvoljeni su samo alfa-numerički znakovi.",
				'differs' => "Ne razlikuje se od prethodne lozinke."
			)

        ),
        array(
            'field' => 'conf_password',
            'label' => 'Potvrđena lozinka',
			'rules' => 'trim|required|matches[new_password]|callback_change_user_password',
			'errors' => array(
				'required' => "Ovo polje je obavezno.",
				'matches' => "Razlikuje se od Lozinke."
			)

        )
    ),
    "update_location"=>array(
    	array(
            'field' => 'latitude',
            'label' => 'Latitude',
			'rules' => 'trim|numeric',
			'errors' => array(
				'required' => "Ovo polje je obavezno.",
				'numeric' => "Dozvoljeni su samo brojevi"
			)

        ),
        array(
            'field' => 'longitude',
            'label' => 'Longitude',
			'rules' => 'trim|numeric',
			'errors' => array(
				'required' => "Ovo polje je obavezno.",
				'numeric' => "Dozvoljeni su samo brojevi"
			)

        )
    ),
    "update_company_data"=>array(
    	array(
            'field' => 'name',
            'label' => 'Ime',
			'rules' => 'trim|alpha_numeric_spaces',
			'errors' => array(
				'required' => "Ovo polje je obavezno.",
				'alpha_numeric_spaces' => "Dozvoljena su samo slova i numerički znakovi."
			)

        ),
        array(
            'field' => 'address',
            'label' => 'Adresa',
			'rules' => 'trim',
			'errors' => array(
				'required' => "Ovo polje je obavezno."
			)

        ),
        array(
            'field' => 'phone1',
            'label' => 'Telefon',
			'rules' => 'trim|numeric',
			'errors' => array(
				'numeric' => "Dozvoljeni su samo brojevi"
			)

        ),
        array(
            'field' => 'phone2',
            'label' => 'Telefon',
			'rules' => 'trim|numeric',
			'errors' => array(
				'numeric' => "Dozvoljeni su samo brojevi"
			)

        ),
        array(
            'field' => 'city',
            'label' => 'Grad',
			'rules' => 'trim|numeric',
			'errors' => array(
				'required' => "Ovo polje je obavezno.",
				'numeric' => "Dozvoljeni su samo brojevi"
			)

        ),
        array(
            'field' => 'website',
            'label' => 'Website',
			'rules' => 'trim|valid_url',
			'errors' => array(
				'valid_url' => "Adresa nije ispravno unesena."
			)

        ),
        array(
            'field' => 'info',
            'label' => 'Opis',
			'rules' => 'trim'

        )
    ),
    
);